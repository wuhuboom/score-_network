<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;


use App\Service\OrderSettlementService as Service;
use App\Service\ProductService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class OrderSettlement extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['o.user_id'] = [$this->param['user_id'], '='];
        }
        if(!empty($this->param['vip_id'])) {
            $where['p.vip_id'] = [$this->param['vip_id'], '='];
        }
        if(!empty($this->param['agent_id'])) {
            $where['u.agent_id'] = [$this->param['agent_id'], '='];
        }
        if(!empty($this->param['order_id'])) {
            $where['s.order_id'] = [$this->param['order_id'], '='];
        }
        if(!empty($this->param['type'])) {
            $where['o.type'] = [$this->param['type'], '='];
        }
        if(!empty($this->param['product_type'])) {
            $where['o.product_type'] = [$this->param['product_type'], '='];
        }
        if(!empty($this->param['status'])) {
            $where['s.status'] = [$this->param['status']==1?1:-1, '='];
        }
        if(!empty($this->param['settlement_status'])) {
            $where['s.settlement_status'] = [$this->param['settlement_status']==1?1:0, '='];
        }
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }

        if(!empty($this->param['is_del'])) {
            $where['o.is_del'] = [$this->param['is_del']==1?1:0, '='];
        }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $field = 's.*,u.username,u.nickname,p.name as product_name,p.image,p.type as product_type,v.code as vip';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = Service::create()->joinSelectList($where,$field,$page,$limit,'s.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            DbManager::getInstance()->startTransaction();
            $data = $this->param;
            $product = ProductService::create()->get($data['product_id']??0);

            if(empty($product)||$product['status']!=3){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0, [], '产品不存在或不在销售中');return false;
            }
            if($product['stock']<$data['buy_share']){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0, [], '产品库存不足，剩余库存'.$product['stock']);return false;
            }

            $data['price']            = $product['price'] ?? 0;
            $data['revenue_days']     = $product['revenue_days'] ?? 0;                //收益天数
            $data['order_money']      = $data['price'] * $data['buy_share'];          //订单金额
            $data['daily_yield']      = $product['daily_yield'] ?? 0;                 //每天收益比例
            $data['daily_income']     = $data['price'] * $data['daily_yield'];        //每日收益
            $data['estimated_income'] = $data['daily_income'] * $data['revenue_days'];//预估总收益
            $data['expire_time'] = date('Y-m-d 23:59:59',time()+$data['revenue_days']*24*3600);//预估总收益
            $data['generated_money']  = 0;//预估总收益
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');

            $result = Service::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            $res = ProductService::create()->update($product['id'],['stock'=>QueryBuilder::dec($data['buy_share']),'update_time'=>date('Y-m-d H:i:s')]);
            if($res&&$insert_id =  Service::create()->save($data)){
                DbManager::getInstance()->commit();
                $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增订单成功');return false;
            }else{
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0, [], '新增订单失败');return false;
            }
        }catch (\Exception $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }
    }

    /**
     * 更新
     */
    public function edit(){

        try {
            if (!empty($this->param['id'])) {
                $data                = $this->param;
                $data['update_time'] = date('Y-m-d H:i:s');

                $result              = Service::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(Service::create()->getOne(['card_number'=>$data['card_number'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '卡号已存在');return false;
                }
                if (Service::create()->update($this->param['id'],$data )) {

                    $this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功'.$result);
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
    }


    /**
     * 作废订单
     */
    public function cancel(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            $list = Service::create()->getLists(['id'=>[$ids,'in'],'settle_status'=>1]);
            if($list['list']){
                $this->AjaxJson(0, $list, '已完成的结算订单不能作废');return false;
            }
            if( Service::create()->update(['id'=>[$ids,'in']],['status'=>-1])){
                $this->AjaxJson(1, ['status'=>1], '结算订单作废成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '结算订单作废失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要作废的数据');
        }
        return false;
    }



    /**
     * 恢复订单
     */
    public function restore(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            $list = Service::create()->getLists(['id'=>[$ids,'in'],'settle_status'=>1]);
            if($list['list']){
                $this->AjaxJson(1, [], '已完成的结算订单不需要恢复');return false;
            }
            if( Service::create()->update(['id'=>[$ids,'in'],'status'=>-1],['status'=>1,'update_time'=>date('Y-m-d H:i:s')])){
                $this->AjaxJson(1, [], '结算订单恢复成功');return false;
            }else{
                $this->AjaxJson(0, [], '结算订单恢复失败');return false;
            }
        }else{
            $this->AjaxJson(0, [], '请选择要恢复的数据');
        }
        return false;
    }

}

