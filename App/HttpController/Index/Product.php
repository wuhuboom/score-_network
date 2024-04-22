<?php

namespace App\HttpController\Index;

use App\HttpController\Common\Common;
use App\HttpController\Common\Invite;
use App\Service\OrderService;
use App\Service\OrderService as Service;
use App\Service\OrderSettlementService;
use App\Service\ProductService;
use App\Service\UserService;
use App\Service\VipService;

use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;


/**
 * Class Users
 * Create With Automatic Generator
 */
class Product extends Base
{
    //首页
    public function details()
    {
        $product = ProductService::create()->get(['id'=>$this->param['id']]);
        $product['vip'] = VipService::create()->get($product['vip_id']);
        $user = UserService::create()->get($this->user_id);
        $this->assign['balance'] = $user['balance_in']+$user['balance_out'];
        $this->assign['product'] = $product;
	    $this->assign['title'] = $this->lang=='Cn'?'购买产品':'Buy Product';
        $this->view('index/product/details',$this->assign);
    }

    //购买产品
    public function buy(){

	    try{
		    DbManager::getInstance()->startTransaction();
		    $product_id = $this->param['product_id'];
		    $buy_share = $this->param['buy_share'];
		    if(empty($this->param['product_id'])){
			    $msg = $this->lang=='Cn'?'请选择你要购买的产品':'Please select the product you want to purchase';
			    $this->AjaxJson(0,[],$msg);
		    }
		    if(empty($this->param['buy_share'])){
			    $msg = $this->lang=='Cn'?'请选择你要购买的产品数量':'Please select the quantity of products you want to purchase';
			    $this->AjaxJson(0,[],$msg);
		    }
		    $product = ProductService::create()->get($product_id??0);

		    if(empty($product)||$product['status']!=3){
			    if($product['status']==2){
				    DbManager::getInstance()->rollback();
				    $msg = $this->lang=='Cn'?'预售产品暂时不能购买':'Pre sale products are temporarily unavailable for purchase';
				    $this->AjaxJson(0, [], $msg);return false;
			    }
			    DbManager::getInstance()->rollback();
			    $msg = $this->lang=='Cn'?'产品不存在或已下架':'The product does not exist or has been taken down from the shelves';
			    $this->AjaxJson(0, [], $msg);return false;
		    }
		    $buy_num = Service::create()->where(['user_id'=>[$this->user_id??0,'='],'product_id'=>$product['id']])->count()??0;

		    if(($buy_share+$buy_num)>$product['maximum_share']){
			    $this->AjaxJson(0,[],"You can only purchase a maximum of {$product['maximum_share']} copies");return false;
		    }
		    if($product['stock']<$buy_share){
			    DbManager::getInstance()->rollback();
			    $msg = $this->lang=='Cn'?'产品库存不足':'Insufficient product inventory';
			    $this->AjaxJson(0, [], $msg);return false;
		    }
		    $user = UserService::create()->get($this->user_id);
			$product_vip = VipService::create()->get($product['vip_id']);
		    $user_vip = VipService::create()->get($user['vip_id']);
		    if($product_vip['level']>$user_vip['level']){
		    	//Your VIP level is insufficient. The current product requires VIP 4 to be purchased
			    DbManager::getInstance()->rollback();
			    $msg = $this->lang=='Cn'?"您的vip等级不足，当前产品要{$product_vip['name']}才能购买":"Your VIP level is insufficient. The current product requires {$product_vip['name']} to be purchased";
			    $this->AjaxJson(0, [], $msg);return false;
		    }
		    if(($user['balance_in']+$user['balance_out'])<($buy_share*$product['price'])){
			    DbManager::getInstance()->rollback();
			    $msg = $this->lang=='Cn'?"您的账户余额不足！":"Your account balance is insufficient!";
			    $this->AjaxJson(0, [$this->user_id,$user['recharge_balance'],$buy_share*$product['price']], $msg);return false;
		    }
		    $data['user_id'] = $user['id'];
		    $data['product_id'] = $product['id'];
		    $data['buy_share'] = $buy_share;
		    $data['product_type'] = $product['type'];
		    $data['price'] = $product['price'] ?? 0;
		    $data['revenue_days'] = $product['revenue_days'] ?? 0;                                    //收益天数
		    $data['order_money'] = $data['price'] * $data['buy_share'];                               //订单金额
		    $data['daily_yield'] = $product['daily_yield'] ?? 0;                                      //每天收益比例
		    $data['daily_income'] = $data['buy_share']*$data['price'] * $data['daily_yield'];                            //每日收益
		    $data['estimated_income'] = $data['daily_income'] * $data['revenue_days'];                //预估总收益
		    $data['expire_time'] = date('Y-m-d H:i:s', time() + $data['revenue_days'] * 24 * 3600);//预估总收益
		    $data['generated_money'] = 0;                                                             //预估总收益
		    $data['create_time'] = date('Y-m-d H:i:s');
		    $data['update_time'] = date('Y-m-d H:i:s');

		    $result = Service::create()->validateData($data,'add');
		    if($result!==true) {
			    $this->AjaxJson(0,$data,$result);return false;
		    }
		    $customer_config = Common::getSystem()['customer_config'];
		    if($customer_config['active_mode']==2&&$user['is_active']==0){
			    $user_data['is_active'] = 1;
			    $user_data['active_time'] = date('Y-m-d H:i:s');
		    }
            if($user['balance_in']<$data['order_money']){
                //更新用户余额
	            if($user_data['balance_in']>0){
		            $user_data['balance_in'] = QueryBuilder::dec($user['balance_in']);
	            }

                $user_data['balance_out'] = QueryBuilder::dec($data['order_money']-$user['balance_in']);
                $user_data['update_time'] = date('Y-m-d H:i:s');
                $user_res = UserService::create()->update($user['id'],$user_data);

                //充值余额变更
                $balance_type = 1;
                $type = 6;
                $balance = 0-$user['balance_in'];
                $before_balance = $user['balance_in'];
                $after_balance =  $user['balance_in']+$balance;
                $remark = '购买产品';
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
                //提现余额变更
                $balance_type = 2;
                $type = 6;
                $balance = 0-($data['order_money']-$user['balance_in']);
                $before_balance = $user['balance_out'];
                $after_balance =  $user['balance_out']+$balance;
                $remark = '购买产品';
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
            }else{
                //更新用户余额
                $user_data['balance_in'] = QueryBuilder::dec($data['order_money']);
                $user_data['update_time'] = date('Y-m-d H:i:s');
                $user_res = UserService::create()->update($user['id'],$user_data);
                //余额变更
                $balance_type = 1;
                $type = 6;
                $balance = 0-$data['order_money'];
                $before_balance = $user['balance_in'];
                $after_balance =  $user['balance_in']+$balance;
                $remark = '购买产品';
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
            }

		    //更新产品库存
		    $product_res = ProductService::create()->update($product['id'],['stock'=>QueryBuilder::dec($data['buy_share']),'update_time'=>date('Y-m-d H:i:s')]);

		    if($user_res&&$product_res&&$UserBalanceDetailsId&&$order_id =  Service::create()->save($data)){
		    	if(!$user['is_active']){
				    //激活奖励
		    		Invite::ActiveReward($user['id']);
                    if($user['parent_id']){
                        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
                        $task->async(new \App\Task\UserVipLevel(['user_id'=>$user['parent_id']]));     // 投递异步任务
                    }
			    }

                $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
                $task->async(new \App\Task\UserVipLevel(['user_id'=>$user['id']]));     // 投递异步任务
		    	//佣金奖励
		    	Invite::productRewards($product['type'],floatval($data['order_money']),$data['user_id']);

			    DbManager::getInstance()->commit();

			    $msg = $this->lang=='Cn'?"购买产品成功":"Product purchase successful";
			    $this->AjaxJson(1, ['order_id'=>$order_id], $msg);return false;
		    }else{
			    DbManager::getInstance()->rollback();
			    $msg = $this->lang=='Cn'?"购买产品失败，请重试！":"Product purchase failed, please try again!";
			    $this->AjaxJson(0, [], $msg);return false;
		    }
	    }catch (\Exception $e){
		    DbManager::getInstance()->rollback();
		    $msg = $this->lang=='Cn'?"购买产品失败，请重试！":"Product purchase failed, please try again!";
		    $this->AjaxJson(0,[], $msg);return false;
	    }
    }

    //订单列表
    public function orders(){

	    $this->assign['title'] = $this->lang=='Cn'?'我的产品':'My Product';
	    $this->view('index/product/orders',$this->assign);
    }

	//订单详情
	public function orderDetails(){
    	$order = OrderService::create()->get($this->param['id']);

    	if($order['user_id']==$this->user_id){

		    $this->assign['order'] = $order;
		    $this->assign['order_settlement'] = OrderSettlementService::create()->getLists(['order_id'=>$order['id'],'user_id'=>$this->user_id,'status'=>1],'*',0,0,'date desc')['list'];

	    }else{
		    $this->assign['order'] = [];
		    $this->assign['order_settlement'] = [];
	    }
		$product = ProductService::create()->get(['id'=>$order['product_id']]);
		$product['vip'] = VipService::create()->get($product['vip_id']);
		$this->assign['product'] = $product;
		$this->assign['title'] = $this->lang=='Cn'?'我的产品':'My Product';
		$this->view('index/product/order_details',$this->assign);
	}
}

