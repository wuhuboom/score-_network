<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;

use App\Service\BankService;
use App\Service\UserBankService;
class UserBank extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['ub.user_id'] = [$this->param['user_id'], '='];
        }
        if(!empty($this->param['agent_id'])) {
            $where['u.agent_id'] = [$this->param['agent_id'], '='];
        }
        if(!empty($this->param['type'])) {
            $where['u.type'] = [$this->param['type'], '='];
        }
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }
        if(!empty($this->param['bank_name'])) {
            $where['ub.bank_name'] = ["%{$this->param['bank_name']}%", 'like'];
        }
        if(!empty($this->param['bank_code'])) {
            $where['ub.bank_code'] = ["%{$this->param['bank_code']}%", 'like'];
        }
        if(!empty($this->param['card_holder_name'])) {
            $where['ub.card_holder_name'] = ["%{$this->param['card_holder_name']}%", 'like'];
        }
        if(!empty($this->param['card_number'])) {
            $where['ub.card_number'] = ["%{$this->param['card_number']}%", 'like'];
        }

        if(!empty($this->param['is_del'])) {
            $where['ub.is_del'] = [$this->param['is_del']==1?1:0, '='];
        }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $field = 'ub.*,u.username,u.nickname';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = UserBankService::create()->joinSelectList($where,$field,$page,$limit,'ub.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $bank = BankService::create()->getOne(['id'=>$data['bank_id']??0]);
            $data['bank_code'] = $bank['bank_code']??'';
            $data['bank_name'] = $bank['bank_name']??'';
            $result = UserBankService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(UserBankService::create()->getOne(['card_number'=>$data['card_number']])){
                $this->AjaxJson(0, [], '卡号已存在');return false;
            }
            if($insert_id =  UserBankService::create()->save($data)){
                $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
            }else{
                $this->AjaxJson(0, [], '新增失败');return false;
            }
        }catch (\Exception $e){
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
                $bank = BankService::create()->getOne(['id'=>$data['bank_id']??0]);
                $data['bank_code'] = $bank['bank_code']??'';
                $data['bank_name'] = $bank['bank_name']??'';
                $result              = UserBankService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(UserBankService::create()->getOne(['card_number'=>$data['card_number'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '卡号已存在');return false;
                }
                if (UserBankService::create()->update($this->param['id'],$data )) {

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
     * 标记删除
     */
    public function isDel(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( UserBankService::create()->update(['id'=>[$ids,'in']],['is_del'=>1])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的数据');
        }
        return false;
    }


    /**
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( UserBankService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '永久删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '永久删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要永久删除的数据');
        }
        return false;
    }

    /**
     * 全部
     */
    public function all(){
        $list = UserBankService::create()->getLists([],'id as value, name',0,0,'id asc');
        $this->AjaxJson(1, $list['list'], 'OK');
        return true;
    }

}

