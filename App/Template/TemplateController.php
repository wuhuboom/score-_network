<?php

namespace App\HttpController\Admin;

use App\Model\%s;

/**
 * Class Users
 * Create With Automatic Generator
 */
class %s extends \App\HttpController\Admin\Base
{
    /**
     * 列表
     */
    public function lists(){
        $model = %s::create();
        $order = $this->getOrderBy();
        if(!empty($this->param['name'])){ $model->where('name like "%'.$this->param['name'].'%"'); }
        $field = "*";
        $list = $model->withTotalCount()->order($order['field'], $order['sort'])->field($field)->limit($this->limit * ($this->page - 1), $this->limit)->all();
        $total = $model->lastQueryResult()->getTotalCount();
        $this->writeJson(200, ['total'=>$total,'list'=>$list], 'success');
        return true;
    }
    /**
     * 新增
     */
    public function add(){
        $model = '';
        $data = $this->param;
        $data['create_time'] = time();
        $data['update_time'] = time();
        if(BankModel::create()->where('name',$data['name'])->get()){
            $this->writeJson(Status::CODE_BAD_REQUEST, ['status'=>0], '名称已存在');return false;
        }
        $result = BankModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = BankModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }

        return false;
    }

    /**
     * 更新
     */
    public function edit(){
        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;
                $data['update_time'] = time();

                if (BankModel::create()->where('name', $data['name'])->where('id', $this->param['id'], '<>')->get()) {
                    $this->AjaxJson(0, ['status' => 0], '名称已存在');
                    return false;
                }

                $result = BankModel::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if (BankModel::create()->update($data, ['id' => $this->param['id']])) {
                    $this->AjaxJson(1,['status' => 1], '更新成功');
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
     * 删除品牌
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( BankModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(0, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的');
        }
        return false;
    }
    /**
     * 全部
     */
    public function all(){
        $model  = BankModel::create();
        $list = $model->withTotalCount()->field('id as value, name')->order('sort', 'asc')->all();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }

}

