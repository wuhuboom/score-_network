<?php
namespace App\HttpController\Admin;

use App\HttpController\Common\Pay;
use App\HttpController\Common\QePay;
use App\Log\LogHandler;
use App\Model\UserCashOutModel;
use App\Model\UserModel;
use App\Service\UserCashOutService;
use App\Service\UserService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class UserCashOut extends \App\HttpController\Admin\Base
{
    /**
     * 余额明细
     */
    public function Lists(){
        $where = [];
        if(!empty($this->param['id']) ){ $where['c.user_id'] = [$this->param['id'],'='];}
        if(!empty($this->param['username']) ){$where['u.username'] = ["%{$this->param['username']}%",'like'];}
        if(!empty($this->param['start'])){ $where['c.create_time'] = [$this->param['start'],'>='];  }
        if(!empty($this->param['end'])){ $where['c.end'] = [$this->param['end'],'<='];  }
        if(!empty($this->param['type'])){ $where['c.type'] = [$this->param['type'],'='];  }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $limit =$this->param['limit']??10;
        $page =$this->param['page']??1;
        $field = 'c.*,u.username,u.nickname,admin.nickname as admin_name,bank.bank_code,bank.card_holder_name,bank.card_number';
        $data = UserCashOutService::create()->joinSelectList($where,$field,$page,$limit,'c.id desc');

        $this->writeJson(200, $data, 'success');

        return true;

    }

    public function pay(){
        try{
	        DbManager::getInstance()->startTransaction();
	        if(empty($this->param['id'])){
		        DbManager::getInstance()->rollback();
		        $this->AjaxJson(0,[],'提现ID必须');return false;
	        }
	        $withdrawal = UserCashOutModel::create()->where('id',$this->param['id'])->find();
	        if(empty($withdrawal)){
		        DbManager::getInstance()->rollback();
		        $this->AjaxJson(0,[],'订单不存在');return false;
	        }
	        if($withdrawal['status']==1){
		        DbManager::getInstance()->rollback();
		        $this->AjaxJson(0,[],'此提现订单已放款，不能重复放款');return false;
	        }
	        if($withdrawal['status']!=0){
		        DbManager::getInstance()->rollback();
		        $this->AjaxJson(0,[],'未付款订单才能放款');return false;
	        }

	        $res = UserCashOutModel::create()->where('id',$withdrawal['id'])->update(['status'=>1,'finish_time'=>date('Y-m-d H:i:s')]);
            if($res){
	            $mch_transferId = $withdrawal['order_no'];
	            $transfer_amount= $withdrawal['money'];
	            $apply_date= $withdrawal['create_time'];
	            $bank_code= $withdrawal['bank_code'];
	            $receive_name= $withdrawal['receive_name'];
	            $receive_account= $withdrawal['receive_account'];
	            $back_url = $this->host.'/withdrawalNotify';
	            $payInfo = QePay::transfer($mch_transferId,$transfer_amount,$apply_date,$bank_code,$receive_name,$receive_account,$back_url);
	            if($payInfo['respCode']!=='SUCCESS'){
		            DbManager::getInstance()->rollback();
		            $this->AjaxJson(0, $payInfo, '放款失败请重试:'.$payInfo['errorMsg']);
		            return false;
	            }
	            DbManager::getInstance()->commit();
	            $this->AjaxJson(1, $payInfo, '放款成功');
	            return false;
            }else{
	            DbManager::getInstance()->rollback();
	            $this->AjaxJson(0,[],'放款失败请重试！');return false;
            }

        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,[],$e->getMessage());return false;
        }
    }

    public function refund(){
	    try{
		    if(empty($this->param['id'])){
			    DbManager::getInstance()->rollback();
			    $this->AjaxJson(0,[],'提现ID必须');return false;
		    }
		    $withdrawal = UserCashOutModel::create()->where('id',$this->param['id'])->find();
		    if(empty($withdrawal)){
			    DbManager::getInstance()->rollback();
			    $this->AjaxJson(0,[],'订单不存在');return false;
		    }
		    if($withdrawal['status']!=0){
			    DbManager::getInstance()->rollback();
			    $this->AjaxJson(0,[],'未付款订单才能退回');return false;
		    }
		    $save_data['status'] = -1;
		    $save_data['update'] = date('Y-m-dH:i:s');

		    $withdraw_res = UserCashOutService::create()->update($withdrawal['id'],$save_data);

		    $user = UserService::create()->get($withdrawal['user_id']);
		    $balance_in = $withdrawal['withdrawal_money']+0;


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
		    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($withdrawal['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
		    if($withdraw_res&$result&&$UserBalanceDetailsId){
			    DbManager::getInstance()->commit();
			    $this->AjaxJson(1,[],'退回成功！');return false;
			    return false;
		    }else{
			    DbManager::getInstance()->rollback();
			    $this->AjaxJson(0,[],'退回失败请重试！');return false;
			    return false;
		    }
	    }catch (\Throwable $e){
		    DbManager::getInstance()->rollback();
		    $this->AjaxJson(0,[],$e->getMessage());return false;
	    }
    }

    /**
     * respCode	响应状态	String	Y	SUCCESS：响应成功 FAIL:响应失败
    errorMsg	响应失败原因	String	Y	响应成功时为 null
    以下参数只有响应成功才有值
    mchId	商户号	String	Y
    merTransferId	商家转账单号	BigDecimal	Y
    transferAmount	转账金额	String	Y
    tradeResult	业务结果	Int	Y	0:申请成功
    1:转账成功
    2:转账失败
    3:转账拒绝
    4:处理中
     * @return false|void
     **/
    public function check(){
        try{
            if(empty($this->param['id'])){

                $this->AjaxJson(0,[],'提现ID必须');return false;
            }
            $withdrawal = UserCashOutModel::create()->where('id',$this->param['id'])->find();
            $res = QePay::queryTransfer($withdrawal['order_no']);
            $log_contents = "检测提现：".json_encode($res,JSON_UNESCAPED_UNICODE);
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'withdraw');
            if($res['respCode']=='SUCCESS'){
                $tradeResult = ['1' => '转账成功','2' => '转账失败','3' => '转账拒绝','4' => '处理中','0' => '查询失败，无状态返回，请联系服务商'];
                $this->AjaxJson(1,$res,$tradeResult[$res['tradeResult']]??'查询失败，无状态返回，请联系服务商');return false;
            }else{
                $this->AjaxJson(0,$res,'检测失败');return false;
            }
        }catch (\Throwable $e){

            $this->AjaxJson(0,[],$e->getMessage());return false;
        }
    }

}

