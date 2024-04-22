<?php

namespace App\HttpController\Admin;


use App\Model\ApiGroupModel;
/**
 * Class Users
 * Create With Automatic Generator
 */
class ApiGroup extends \App\HttpController\Admin\Base
{
    /**
     * 标签列表
     */
    public function lists(){
        $param = $this->request()->getRequestParam();
        $page = (int)($param['page']??1);
        $limit = (int)($param['limit']??20);
        $model = ApiGroupModel::create();
        if(!empty($this->param['type'])){ $model->where('type',$this->param['type']); }
        if(!empty($this->param['name'])){ $model->where('name like "%'.$this->param['name'].'%"'); }

        $field = '*';
        $list = $model->withTotalCount()->alias('g')
            ->join('(select count(*) as num,group_id from td_api group by group_id) a','a.group_id = g.id','LEFT')
            ->order('id', 'DESC')
            ->field($field)->limit($limit * ($page - 1), $limit)->all();
        $total = $model->lastQueryResult()->getTotalCount();;
        $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
        return true;
    }
    /**
     * 新增
     */
    public function add(){
        $data = $this->param;
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $result = ApiGroupModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = ApiGroupModel::create()->data($data)->save()){
                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
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
                $data = $this->param;
                $data['update_time'] = date('Y-m-d H:i:s');
                $ApiGroupModel = ApiGroupModel::create();
                $result = $ApiGroupModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($ApiGroupModel->where('id',$this->param['id'])->update($data)) {
                    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '更新成功');
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
            if( ApiGroupModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除标签成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除标签失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的标签');
        }
        return false;
    }
    
    /**
     * 全部
     */
    public function all(){
        $model  = ApiGroupModel::create();

        $list = $model->withTotalCount()->field('id as value, name')->order('sort', 'asc')->all();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }

}

