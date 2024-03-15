<?php

namespace App\HttpController\Admin;

use App\Service\CountryService;
class Country extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['Country_name'])) {
            $where['name'] = ["%{$this->param['name']}%", 'like'];
        }
        if(!empty($this->param['cc'])) {
            $where['cc'] = ["%{$this->param['cc']}%", 'like'];
        }
     
        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = CountryService::create()->getLists($where,$field,$page,$limit,'sort asc,id asc');

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
            $result = CountryService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(CountryService::create()->getOne(['name'=>$data['name']])){
                $this->AjaxJson(0, [], '国家名称已存在');return false;
            }
            if(CountryService::create()->getOne(['cc'=>$data['cc']])){
                $this->AjaxJson(0, [], '国家简称已存在');return false;
            }
            if($insert_id =  CountryService::create()->save($data)){
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
                $result              = CountryService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(CountryService::create()->getOne(['cc'=>$data['cc'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '国家简称已存在');return false;
                }

                if(CountryService::create()->getOne(['name'=>$data['name'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '国家名称已存在');return false;
                }
                if (CountryService::create()->update($this->param['id'],$data )) {
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
            if( CountryService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的国家');
        }
        return false;
    }

    /**
     * 全部
     */
    public function all(){
        $list = CountryService::create()->getLists([],'id as value, CONCAT("【",cc,"】",name) as name',0,0,'id asc');
        $this->AjaxJson(1, $list['list'], 'OK');
        return true;
    }

}

