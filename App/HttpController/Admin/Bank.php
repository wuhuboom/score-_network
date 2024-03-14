<?php

namespace App\HttpController\Admin;

use App\Service\BankService;
class Bank extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['bank_name'])) {
            $where['bank_name'] = ["%{$this->param['bank_name']}%", 'like'];
        }
        if(!empty($this->param['bank_code'])) {
            $where['bank_code'] = ["%{$this->param['bank_code']}%", 'like'];
        }
     
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = BankService::create()->getLists($where,$field,$page,$limit,'id desc');

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
            $result = BankService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(BankService::create()->getOne(['bank_name'=>$data['bank_name']])){
                $this->AjaxJson(0, [], '银行名称已存在');return false;
            }
            if(BankService::create()->getOne(['bank_code'=>$data['bank_code']])){
                $this->AjaxJson(0, [], '银行编码已存在');return false;
            }
            if($insert_id =  BankService::create()->save($data)){
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
                $result              = BankService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(BankService::create()->getOne(['bank_code'=>$data['bank_code'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '银行编码已存在');return false;
                }

                if(BankService::create()->getOne(['bank_name'=>$data['bank_name'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '银行名称已存在');return false;
                }
                if (BankService::create()->update($this->param['id'],$data )) {
                    $this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功');
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
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( BankService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的银行');
        }
        return false;
    }

    /**
     * 全部
     */
    public function all(){
        $list = BankService::create()->getLists([],'id as value, CONCAT("【",bank_code,"】",bank_name) as name',0,0,'id asc');
        $this->AjaxJson(1, $list['list'], 'OK');
        return true;
    }

}

