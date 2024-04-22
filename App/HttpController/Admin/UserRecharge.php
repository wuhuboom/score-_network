<?php
namespace App\HttpController\Admin;

use App\HttpController\Common\Pay;
use App\Model\UserRechargeModel;
use App\Model\UserModel;
use App\Service\UserRechargeService;
use App\Service\UserService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class UserRecharge extends \App\HttpController\Admin\Base
{
    /**
     * 余额明细
     */
    public function Lists(){
        $where = [];
        if(!empty($this->param['id']) ){ $where['b.user_id'] = [$this->param['id'],'='];}
        if(!empty($this->param['user_id']) ){ $where['b.user_id'] = [$this->param['user_id'],'='];}
        if(!empty($this->param['username']) ){$where['u.username'] = ["%{$this->param['username']}%",'like'];}
        if(!empty($this->param['start'])){ $where['b.create_time'] = [$this->param['start'],'>='];  }
        if(!empty($this->param['end'])){ $where['b.end'] = [$this->param['end'],'<='];  }
        if(!empty($this->param['type'])){ $where['b.type'] = [$this->param['type'],'='];  }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $limit =$this->param['limit']??10;
        $page =$this->param['page']??1;
        $field = 'r.*,u.username,u.nickname,admin.nickname as admin_name';
        $data = UserRechargeService::create()->joinSelectList($where,$field,$page,$limit,'r.id desc');

        $this->writeJson(200, $data, 'success');

        return true;

    }
    /**
     * 新增
     */
    public function add(){
        try{
            $data = $this->param;
            if(empty($data['money'])){
                $this->AjaxJson(0, [], '充值金额必须大于0');return false;
            }
            if($data['money']<=$data['tax_money']){
                $this->AjaxJson(0, [], '充值手续费不能大于充值金额');return false;
            }
            $data['order_no'] = date('YmdHis').rand(100000,999999);
            $data['received_money'] = $data['money']-$data['tax_money'];
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = UserRechargeService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }

            if($insert_id =  UserRechargeService::create()->save($data)){
                $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
            }else{
                $this->AjaxJson(0, [], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }
    }

    /**
     * 编辑
     */
    public function edit(){
        try {
            DbManager::getInstance()->startTransaction();
            $data =$this->param;
            $result = UserRechargeService::create()->validateData($data,'edit');
            if($result!==true) {
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,$data,$result);return false;
            }
            $recharge = UserRechargeService::create()->get($data['id']??0);
            if(empty($recharge)){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,[], '数据不存在');return false;
            }
            if($recharge['status']==1){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,[], '此充值已入账，不可再操作');return false;
            }
            if($data['status']==1){
              $data['cost_time'] = time()-strtotime($recharge['create_time']);
              $data['finish_time'] = date('Y-m-d H:i:s');
            }
            if (UserRechargeService::create()->update($data['id'],$data )) {
                if($data['status']==1){
                    $user = UserService::create()->get($recharge['user_id']);
                    $balance_in = $data['received_money']??0;
                    if(empty($balance_in)||$balance_in<=0){
                        DbManager::getInstance()->rollback();
                        $this->AjaxJson(0,[], '入账金额不能小于0');return false;
                    }
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
                    $remark = '充值到账';
                    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($recharge['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
                    if($result&&$UserBalanceDetailsId){
                        DbManager::getInstance()->commit();
                        $this->AjaxJson(1, ['sql' => $result],    '充值审核成功');
                        return false;
                    }else{
                        DbManager::getInstance()->rollback();
                        $this->AjaxJson(0, ['status' => 0], '充值审核失败,请重试！');
                        return false;
                    }
                }else{
                    DbManager::getInstance()->commit();
                    $this->AjaxJson(1, [$data], '更新成功');
                    return false;
                }

            } else {
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0, ['status' => 0], '更新失败');
                return false;
            }

        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0, ['msg' => $e->getMessage()], '充值审核失败,请重试！');
            return false;
        }

    }

}

