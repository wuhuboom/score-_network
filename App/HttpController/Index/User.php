<?php

namespace App\HttpController\Index;
use App\HttpController\Admin\UserBank;
use App\HttpController\Common\Common;
use App\HttpController\Common\QePay;
use App\HttpController\Common\Regex;
use App\HttpController\Common\Sms;
use App\Log\LogHandler;
use App\Model\UserModel;
use App\Service\BankService;
use App\Service\MailService;
use App\Service\OrderService;
use App\Service\OrderSettlementService;
use App\Service\ProductService;
use App\Service\UserBankService;
use App\Service\UserCashOutService;
use App\Service\UserRechargeService;
use App\Service\UserRewardService;
use App\Service\UserService;
use App\Service\VipService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class User extends Base
{
    //个人中心
    public function my()
    {
    	$user = UserService::create()->get($this->user_id??0);
	    $this->assign['user'] = $user;
	    $this->assign['invitation_num'] =  UserService::create()->where(['parent_id'=>$this->user_id])->count()??0;
	    $this->assign['buy_money'] = OrderService::create()->where(['user_id'=>$this->user_id,'is_pay'=>1])->sum('order_money')??0;
        $this->assign['order_num'] = OrderService::create()->where(['user_id'=>$this->user_id,'is_del'=>0])->count();
        $this->assign['page_path'] = 'my';
        $this->assign['reward_money'] = UserRewardService::create()->where(['user_id'=>$this->user_id])->sum('balance')??0;
        $this->assign['order_settlement_money'] = OrderSettlementService::create()->where(['user_id'=>$this->user_id,'settle_status'=>1])->sum('settle_money')??0;
		$my_vip = VipService::create()->get($user['vip_id']);
		$this->assign['my_vip'] = $my_vip;
		$this->assign['next_vip'] = VipService::create()->getOne(['level'=>[$my_vip['level']??0,'>']])??[];
        $this->assign['title'] = $this->lang=='Cn'?'个人中心':'My';
        $this->view('index/user/my',$this->assign);
    }

    public function mail(){
	    $user = $this->session()->get('user');
	    $user = UserService::create()->get($user['id']);
        $this->assign['mail'] = MailService::create()->getLists(['user_id'=>$user['id']],'*')['list'];
        $this->assign['title'] = $this->lang=='Cn'?'消息':'Mail';
        $this->view('index/user/mail',$this->assign);
    }
    public function balance_details(){
        $this->assign['title'] = $this->lang=='Cn'?'余额明细':'Balance Details';
        $this->view('index/user/balance_details',$this->assign);
    }

	public function vip(){
		$user = $this->session()->get('user');
		$user = UserService::create()->get($user['id']);
		$this->assign['my_vip'] = VipService::create()->get($user['vip_id']);
		$this->assign['vip_id'] = $user['vip_id'];
		$this->assign['active_num'] =  UserService::create()->where(['parent_id'=>$user['id'],'is_active'=>1])->count();
		$this->assign['buy_money'] = OrderService::create()->where(['user_id'=>$user['id'],'is_pay'=>1])->sum('order_money');
		$this->assign['vip'] = VipService::create()->getLists([],'*',0,0,'level asc')['list'];
		$product =ProductService::create()->joinSelectList(['status'=>[[2,3],'in'],'is_del'=>0],'p.*,v.name  as vip_name,v.level',0,0,'sort asc');
		$this->assign['product'] =$product['list'];
        $this->assign['title'] = $this->lang=='Cn'?'VIP等级':'Vip Level';
		$this->view('index/user/vip',$this->assign);
	}
    //个人信息
    public function info(){
        if($this->request()->getMethod()=='POST'){
            try{
                $avatar = $this->param['avatar']??'';
                $nickname = $this->param['nickname']??'';
                $email = $this->param['email']??'';


                if(empty($avatar)){
                    $this->AjaxJson(0, [], 'Please upload your avatar');return false;
                }
                if(empty($nickname)){
                    $this->AjaxJson(0, [], "Please enter your nickname");return false;
                }
                if(empty($email)||!Regex::is_email($this->param['email'])){
                    $this->AjaxJson(0, [], 'Please enter your email');return false;
                }

                $session_user = $this->session()->get('user');
                $user         = UserService::create()->getOne(['id' => $session_user['id']]);

                $user_info = [
                    'avatar'          => $avatar,
                    'nickname'          => $nickname,
                    'email'        => $email,
                    'update_time'           => date('Y-m-d H:i:s'),
                ];
                if(UserService::create()->update($user['id'],$user_info)){
                    $this->AjaxJson(1, [], 'Bank card information saved successfully');
                    return false;
                }else{
                    $this->AjaxJson(0, [], 'Bank card information saved fail');
                    return false;
                }

            }catch (\Exception $e){
                $this->AjaxJson(0,[], 'Bank card information saved fail');return false;
            }

        }else{
            $session_user = $this->session()->get('user');
            $user = UserService::create()->get($session_user['id']);
            $this->assign['user'] = $user;
            $this->assign['title'] = $this->lang=='Cn'?'设置个人信息':'Setting Info';
            $this->view('index/user/info',$this->assign);
        }
    }

    //提现
    public function withdraw(){
        if($this->request()->getMethod()=='POST'){
            try{
	            DbManager::getInstance()->startTransaction();
                $amount = $this->param['amount']??'';
                $trade_password = $this->param['trade_password']??'';
                $session_user = $this->session()->get('user');
                $user         = UserService::create()->getOne(['id' => $this->user_id]);
	            $config = Common::getSystem()['withdrawal_config'];
                if(empty($amount)||$amount<0){
	                DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, [], 'Please enter the withdrawal amount');return false;
                }
                if($amount<$config['min_amount']||$amount>$config['max_amount']){
	                DbManager::getInstance()->rollback();
	                $this->AjaxJson(0, [], "The withdrawal amount must be between {$config['min_amount']}-{$config['max_amount']}");return false;
                }

                $count = UserCashOutService::create()->where(['user_id'=>$this->user_id,'status'=>1,'create_time'=>[[date('Y-m-d 00:00:00'),date('Y-m-d 23:23:23')],'between']])->count()??0;
                if($count>=$config['num']){
	                DbManager::getInstance()->rollback();
	                $this->AjaxJson(0, [], "Can only withdraw {$config['num']} times a day ");return false;
                }
                if(time()<strtotime(date('Y-m-d '.$config['start_time'])) ||time()>strtotime(date('Y-m-d '.$config['end_time']))){
                	DbManager::getInstance()->rollback();
	                $this->AjaxJson(0, [], "Withdrawable from {$config['start_time']} to {$config['end_time']} ");return false;
                }
                if(empty($trade_password)){
	                DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, [], "Please enter your trade_password");return false;
                }
                if(empty($this->param['user_bank_id'])){
	                DbManager::getInstance()->rollback();
	                $this->AjaxJson(0, [], "Please select a bank card");return false;
                }
                $user_bank = UserBankService::create()->where(['user_id'=>$this->user_id,'id'=>$this->param['user_bank_id']])->get();
	            if(empty($user_bank)){
		            DbManager::getInstance()->rollback();
		            $this->AjaxJson(0, [], "Bank card does not exist");return false;
	            }
	            $receive_name = $user_bank['card_holder_name'];
	            $receive_account = $user_bank['card_number'];

                if($user['balance_out']<$amount){
	                DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, [], "Your withdrawable balance is insufficient");return false;
                }

                if (!Common::passwordVerify($trade_password, $user['cash_password'])) {
	                DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, [], 'The trade password is incorrect');
                    return false;
                }
                $amount = (float)$amount+0;


	            $data['order_no'] = date('YmdHis').rand(100000,999999);;
	            $data['create_time'] = date('Y-m-d H:i:s');
	            $data['bank_name'] = $user_bank['bank_name'];
	            $data['bank_code'] = $user_bank['bank_code'];
	            $data['receive_account'] = $receive_account;
	            $data['receive_name'] = $receive_name;
	            $data['user_bank_id'] = $user_bank['id'];
	            $data['user_id'] = $user['id'];
	            $data['withdrawal_money'] = $amount;
	            $data['tax_money'] = round($data['withdrawal_money']*$config['ratio'],0);
	            $data['money'] = $data['withdrawal_money']-$data['tax_money'];
	            $data['status'] = 0;
	            $user_cash_out_id = UserCashOutService::create()->save($data);
	            $user_res              = UserService::create()->update($user['id'],[
		            'balance_out'      => QueryBuilder::dec($amount) ,
		            'update_time' => date('Y-m-d H:i:s'),
	            ]);


	            $balance_type = 2;
	            $type = 2;
	            $balance = 0-$amount;
	            $before_balance = $user['balance_out'];
	            $after_balance = $user['balance_out']-$balance;
	            $remark = 'balance withdrawal';
	            $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);


                if($user_res&&$user_res&&$UserBalanceDetailsId){
                	DbManager::getInstance()->commit();
                    $this->AjaxJson(1, [], 'Application for withdrawal successful');
                    return false;
                }else{
	                DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, [$user_res,$UserBalanceDetailsId,$amount], 'Application for withdrawal fail!');
                    return false;
                }

            }catch (\Exception $e){
	            DbManager::getInstance()->rollback();
                $this->AjaxJson(0,[$e->getMessage()], 'Application for withdrawal fail');return false;
            }

        }else{
            $session_user = $this->session()->get('user');
            $user = UserService::create()->get($session_user['id']);
            $this->assign['user_bank'] = UserBankService::create()->getLists(['user_id'=>$this->user_id])['list']??[];
            $this->assign['user'] = $user;
            $this->assign['title'] = $this->lang=='Cn'?'提现':'withdraw';
            $this->view('index/user/withdraw',$this->assign);
        }
    }

	//充值
	public function recharge(){
		if($this->request()->getMethod()=='POST'){

			try{
				DbManager::getInstance()->startTransaction();
				$amount = $this->param['amount']??'';

				$user         = UserService::create()->getOne(['id' => $this->user_id]);
				if(empty($amount)||$amount<100||$amount>3000000){
					DbManager::getInstance()->rollback();
					$this->AjaxJson(0, [], 'The recharge amount must be between 100-3000000');return false;
				}
				$data['order_no'] = date('YmdHis').rand(100000,999999);;
				$data['create_time'] = date('Y-m-d H:i:s');
				$data['money'] = $amount;
				$data['user_id'] = $user['id'];
				$data['tax_money'] = 0;
				$data['status'] = 0;
				$data['received_money'] = $data['money']-$data['tax_money'];
				$recharge_id =  UserRechargeService::create()->save($data);
				if(empty($recharge_id)){
					DbManager::getInstance()->rollback();
					$this->AjaxJson(0, [], 'Recharge failed, please try again');return false;
				}
				$goods_name = 'balance recharge';
				$notify_url = $this->host.'/rechargeNotify';
				$page_url = $this->host.'/my';
				$payInfo = QePay::web($data['order_no'],$data['money'],$data['create_time'],$goods_name,$notify_url,$page_url);
				if($payInfo['tradeResult']==1){
					DbManager::getInstance()->commit();
					$this->AjaxJson(1, ['payInfo'=>$payInfo['payInfo']], 'successful');
					return false;
				}else{
					DbManager::getInstance()->rollback();
					$this->AjaxJson(0, $payInfo, 'Recharge exception, please contact customer service for assistance');
					return false;
				}

			}catch (\Exception $e){
				DbManager::getInstance()->rollback();
				$this->AjaxJson(0,[$e->getMessage()], 'Recharge exception, please contact customer service for assistance');return false;
			}

		}else{
			$session_user = $this->session()->get('user');
			$user = UserService::create()->get($session_user['id']);
			$this->assign['user'] = $user;
			$this->assign['bank'] = BankService::create()->getLists()['list'];
			$config = Common::getSystem()['recharge_config'];
			$this->assign['quick_amount'] = explode(',',$config['quick_amount']);

			$this->assign['title'] = $this->lang=='Cn'?'充值':'recharge';
			$this->view('index/user/recharge',$this->assign);
		}
	}

	/**
	 * 参数值    参数名    类型    是否必填    说明
	 * tradeResult    订单状态    String    Y    1：支付成功
	 * mchId    商户号    String    Y
	 * mchOrderNo    商家订单号    String    Y
	 * oriAmount    原始订单金额    String    Y    商家上传的订单金额
	 * amount    交易金额    String    Y    实际支付金额
	 * orderDate    订单时间    String    Y
	 * orderNo    平台支付订单号    String    Y
	 * merRetMsg    透传参数    String    N    下单时未提交则无需参与签名
	 * signType    签名方式    String    Y    不参与签名
	 * sign    签名    String    Y    不参与签名
	 */
	public function rechargeNotify(){
		try {
			DbManager::getInstance()->startTransaction();
			$notify_data = $this->param;
			$log_contents = "充值回调：".json_encode($notify_data,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'recharge');
			$server_ip = ['13.215.197.192','52.220.224.100'];
			if(!in_array($this->getRealIp(),$server_ip)){
				DbManager::getInstance()->rollback();
				$this->response()->write('fail');
				return false;
			}

			if($notify_data['tradeResult']==1){
				$recharge = UserRechargeService::create()->getOne(['order_no'=>$notify_data['mchOrderNo']]);
				if(empty($recharge)||$recharge['status']==1){
					DbManager::getInstance()->rollback();
					$this->response()->write('fail4');
					return false;
				}
				$save_data['status'] = 1;
				$save_data['money'] = $notify_data['amount'];
				$save_data['received_money'] = $save_data['money']-$recharge['tax_money'];
				$save_data['cost_time'] = time()-strtotime($recharge['create_time']);
				$save_data['finish_time'] = date('Y-m-dH:i:s');
				$save_data['remark'] = json_encode($notify_data,JSON_UNESCAPED_UNICODE);
				$recharge_res = UserRechargeService::create()->update($recharge['id'],$save_data);

				$user = UserService::create()->get($recharge['user_id']);
				$balance_in = $save_data['received_money']??0;
				$result              = UserService::create()->update($user['id'],[
					'balance_in'      => QueryBuilder::inc($balance_in) ,
					'sum_balance_in'      => QueryBuilder::inc($balance_in) ,
					'update_time' => date('Y-m-d H:i:s')
				]);
				$balance_type = 1;
				$type = 1;
				$balance = $balance_in;
				$before_balance = $user['balance_in'];
				$after_balance = $user['balance_in']+$balance;
				$remark = 'recharge';
				$UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($recharge['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
				if($recharge_res&$result&&$UserBalanceDetailsId){
					DbManager::getInstance()->commit();
					$this->response()->write('success');
					return false;
				}else{
					DbManager::getInstance()->rollback();
					$this->response()->write('fail2');
					return false;
				}
			}else{
				DbManager::getInstance()->rollback();
				$this->response()->write('fail1');
				return false;
			}

		}catch (\Throwable $e){
			DbManager::getInstance()->rollback();
			$this->response()->write('error');
			return false;
		}

	}

	/**
	 * 参数值    参数名    类型    是否必填    说明
	 * tradeResult    订单状态    String    Y    1:代付成功 2:代付失败
	 * merTransferId    商家转账单号    String    Y    代付使用的转账单号
	 * merNo    商户代码    String    Y    平台分配唯一
	 * tradeNo    平台订单号    String    Y    平台唯一
	 * transferAmount    代付金额    String    Y    元为单位保留俩位小数
	 * applyDate    订单时间    String    Y    订单时间
	 * version    版本号    String    Y    默认1.0
	 * respCode    回调状态    String    Y    默认SUCCESS
	 * sign    签名    String    N    不参与签名
	 * signType    签名方式    String    N    MD5 不参与签名
	 */
	public function withdrawNotify(){
		try {
			DbManager::getInstance()->startTransaction();
			$notify_data = $this->param;
			$log_contents = "提现回调：".json_encode($notify_data,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'withdraw');
			$server_ip = ['13.215.197.192','52.220.224.100'];
			if(!in_array($this->getRealIp(),$server_ip)){
				DbManager::getInstance()->rollback();
				$this->response()->write('fail');
				return false;
			}
			$withdraw = UserCashOutService::create()->getOne(['order_no'=>$notify_data['merTransferId']]);
			if(empty($withdraw)){
				DbManager::getInstance()->rollback();
				$this->response()->write('fail');
				return false;
			}
			if($withdraw['status']==-1){
				DbManager::getInstance()->rollback();
				$this->response()->write('success');
				return false;
			}
			if($notify_data['tradeResult']==1){

				$save_data['status'] = 1;
				$save_data['update'] = date('Y-m-dH:i:s');
				$save_data['finish_time'] = date('Y-m-dH:i:s');
				$save_data['remark'] = json_encode($notify_data,JSON_UNESCAPED_UNICODE);
				$withdraw_res = UserCashOutService::create()->update($withdraw['id'],$save_data);
				if($withdraw_res){
					DbManager::getInstance()->commit();
					$this->response()->write('success');
					return false;
				}else{
					DbManager::getInstance()->rollback();
					$this->response()->write('fail4');
					return false;
				}

			}else if($notify_data['tradeResult']==2){

				$save_data['status'] = -1;
				$save_data['update'] = date('Y-m-dH:i:s');
				$save_data['remark'] = json_encode($notify_data,JSON_UNESCAPED_UNICODE);
				$withdraw_res = UserCashOutService::create()->update($withdraw['id'],$save_data);

				$user = UserService::create()->get($withdraw['user_id']);
				$balance_in = $withdraw['withdrawal_money']+0;


				$result              = UserService::create()->update($user['id'],[
					'balance_out'      => QueryBuilder::inc($balance_in) ,
					'update_time' => date('Y-m-d H:i:s')
				]);

				$balance_type = 2;
				$type = 3;
				$balance = $balance_in;
				$before_balance = $user['balance_out'];
				$after_balance = $user['balance_out']+$balance;
				$remark = 'withdraw return';
				$UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($withdraw['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
				if($withdraw_res&$result&&$UserBalanceDetailsId){
					DbManager::getInstance()->commit();
					$this->response()->write('success');
					return false;
				}else{
					DbManager::getInstance()->rollback();
					$this->response()->write('fail2');
					return false;
				}
			}else{
				DbManager::getInstance()->rollback();
				$this->response()->write('fail1');
				return false;
			}

		}catch (\Throwable $e){
			DbManager::getInstance()->rollback();
			$this->response()->write('error'.$e->getMessage());
			return false;
		}

	}
    //银行卡信息
    public function bankCardInfo(){
        if($this->request()->getMethod()=='POST'){
            try{
                $user_bank_id = $this->param['id']??0;
                $bank_id = $this->param['bank_id']??'';
                $card_holder_name = $this->param['card_holder_name']??'';
                $card_number = $this->param['card_number']??'';

                if(empty($bank_id)){
                    $this->AjaxJson(0, [], 'Please select a bank');return false;
                }
                if(empty($card_holder_name)){
                    $this->AjaxJson(0, [], "Please enter the cardholder's name");return false;
                }
                if(empty($card_number)){
                    $this->AjaxJson(0, [], 'Please enter your bank card number');return false;
                }

                $bank = BankService::create()->get($bank_id);

                $session_user = $this->session()->get('user');
                $user         = UserService::create()->getOne(['id' => $session_user['id']]);

                $user_bank = [
                    'user_id'          => $user['id'],
                    'bank_id'          => $bank_id,
                    'bank_name'        => $bank['bank_name'],
                    'bank_code'        => $bank['bank_code'],
                    'card_holder_name' => $card_holder_name,
                    'card_number'      => $card_number,
                    'status'           => 1,
                    'create_time'           => date('Y-m-d H:i:s'),
                    'update_time'           => date('Y-m-d H:i:s'),
                ];
                if($user_bank_id){
                   if(UserBankService::create()->update($user_bank_id,$user_bank)){
                       $this->AjaxJson(1, [], 'Bank card information saved successfully');
                       return false;
                    }else{
                       $this->AjaxJson(0, [], 'Bank card information saved fail');
                       return false;
                   }
                }else{
                    if (UserBankService::create()->save($user_bank)) {
                        $this->AjaxJson(1, [], 'Bank card information saved successfully');
                        return false;
                    } else {
                        $this->AjaxJson(0, [], 'Bank card information saved fail');
                        return false;
                    }
                }

            }catch (\Exception $e){
                $this->AjaxJson(0,[], 'Bank card information saved fail');return false;
            }

        }else{
            $bank = BankService::create()->getLists([],'*',0,0,'bank_name asc');
            $this->assign['bank'] = $bank['list']??[];
            $session_user = $this->session()->get('user');
            $user_bank = UserBankService::create()->getOne(['id'=>$this->param['id']??0,'user_id'=>$session_user['id']]);
            $this->assign['user_bank'] = $user_bank;
            $this->assign['title'] = $this->lang=='Cn'?'银行卡信息':'Bank Card Info';
            $this->view('index/user/bank_card_info',$this->assign);
        }
    }

    //登录密码
    public function password(){
        if($this->request()->getMethod()=='POST'){
            try{
                $password     = $this->param['password'] ?? '';
                $new_password = $this->param['new_password'] ?? '';
                if (empty($password)) {
                    $this->AjaxJson(0, [], 'Password cannot be empty');
                    return false;
                }
                if (empty($new_password)) {
                    $this->AjaxJson(0, [], 'New Password cannot be empty');
                    return false;
                }
                if (strlen($new_password) > 12 || strlen($new_password) < 6) {
                    $this->AjaxJson(0, [], 'Please enter a password of 6-12 digits');
                    return false;
                }
                $session_user = $this->session()->get('user');
                $user         = UserService::create()->getOne(['id' => $session_user['id']]);
                if (!Common::passwordVerify($password, $user['password'])) {
                    $this->AjaxJson(0, [], 'The original password is incorrect');
                    return false;
                }

                $data['password'] = Common::hashPassword($new_password);

                if (UserService::create()->update($user['id'], $data)) {
                    $this->AjaxJson(1, [], 'Password change successful');
                    return false;
                } else {
                    $this->AjaxJson(0, [], 'Password change fail');
                    return false;
                }
            }catch (\Exception $e){
                $this->AjaxJson(0,[], 'Password change fail');return false;
            }
        }else{
            $this->assign['title'] = $this->lang=='Cn'?'修改密码':'Update Password';
            $this->view('index/user/password',$this->assign);
        }
    }
    //交易密码
    public function tradePassword(){
        if($this->request()->getMethod()=='POST'){
            try{
                $cash_password     = $this->param['trade_password'] ?? '';
                if(strlen($cash_password)!=6){
                    $this->AjaxJson(0, [], 'Please enter a 6-digit transaction password'.$cash_password);return false;
                }
                $data['cash_password'] = Common::hashPassword($cash_password);
                $session_user = $this->session()->get('user');
                $user         = UserService::create()->getOne(['id' => $session_user['id']]);
                if (UserService::create()->update($user['id'], $data)) {
                    $this->AjaxJson(1, [], 'Trade Password change successful');
                    return false;
                } else {
                    $this->AjaxJson(0, [], 'Trade Password change fail');
                    return false;
                }
            }catch (\Exception $e){
                $this->AjaxJson(0,[], 'Trade Password change fail');return false;
            }

        }else{
            $this->assign['title'] = $this->lang=='Cn'?'修改交易密码':'Update Trade Password';
            $this->view('index/user/trade_password',$this->assign);
        }
    }
    /**
     * 获取手机验证码
     */
    public function getHandleCode(){
        if($this->request()->getMethod()=='POST'){
            $session_user = $this->session()->get('user');
            $user         = UserService::create()->getOne(['id' => $session_user['id']]);
            $tel = $user['username'];
            $this->AjaxJson(1,[],'验证码88888888已发送');return  false;
            $code   = rand(100000, 999999);
            $minute = 15;
            $res    = Sms::sendLoginCode($tel, $code, $this->getRealIp(), $minute);
            if($res===true){
                $this->AjaxJson(1,[],'验证码已发送，15分钟内有效！');return  false;
            }else{
                $this->AjaxJson(0,[],$res);return  false;
            }
        }else{
            $this->AjaxJson(0,[],'Access error');return  false;
        }

    }
}

