<?php

namespace App\HttpController\Admin;

use App\Model\AreaModel;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Area extends Base
{
    /**
     * 用户列表
     */
    public function lists(){
        $param = $this->request()->getRequestParam();
        $page = (int)($param['page']??1);
        $limit = (int)($param['limit']??20);
        $model = AreaModel::create();
        if(!empty($this->param['level'])){ $model->where('level',$this->param['level']); }
        if(!empty($this->param['name'])){ $model->where('name',"%{$this->param['name']}%",'like'); }
        $field = "*";
        if(!empty($this->param['order'])){
            $order = explode(' ',$this->param['order']);
        }else{
            $order = ['id','asc'];
        }
        $list = $model->withTotalCount()
            ->order($order[0], $order[1])->field($field)->limit($limit * ($page - 1), $limit)->all();
        $total = $model->lastQueryResult()->getTotalCount();;
        $this->writeJson(200, ['total'=>$total,'list'=>$list], 'success');
        return true;
    }

    /**
     * 全部
     */
    public function all(){
        $model  = AreaModel::create();
        $model->where('parent_id',$this->param['parent_id']??0);
        $list = $model->withTotalCount()->field('id as value, name')->order('sort', 'asc')->select();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }



}

