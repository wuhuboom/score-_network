<?php

namespace App\HttpController\Admin;


use App\Model\ApiModel;
/**
 * Class Users
 * Create With Automatic Generator
 */
class Api extends \App\HttpController\Admin\Base
{
    /**
     * 标签列表
     */
    public function lists(){
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??20);
        $model = ApiModel::create();
        if(!empty($this->param['type'])){ $model->where('g.type',$this->param['type']); }
        if(!empty($this->param['title'])){ $model->where('a.title like "%'.$this->param['title'].'%"'); }
        if(!empty($this->param['group_id'])){ $model->where('a.group_id',$this->param['group_id']); }

        $field = 'a.*,g.name as group_name,g.type as group_type';
        $list = $model->withTotalCount()->alias('a')
                      ->join('td_api_group g','g.id=a.group_id','LEFT')
                      ->order('id', 'DESC')
                      ->field($field)
                      ->limit($limit * ($page - 1), $limit)->all();
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
        $request_params = [];
        foreach ($data['request_params_field'] as $k=>$v){
            $request_params[] = [
                'field'=>$data['request_params_field'][$k],
                'type'=>$data['request_params_type'][$k],
                'required'=>$data['request_params_required'][$k],
                'desc'=>$data['request_params_desc'][$k],
            ];
        }
        $data['request_params'] = json_encode($request_params,JSON_UNESCAPED_UNICODE);
        $response_params = [];
        foreach ($data['response_params_field'] as $k=>$v){
            $response_params[] = [
                'field'=>$data['response_params_field'][$k],
                'type'=>$data['response_params_type'][$k],
                'required'=>$data['response_params_required'][$k],
                'desc'=>$data['response_params_desc'][$k],
            ];
        }
        $data['response_params'] = json_encode($response_params,JSON_UNESCAPED_UNICODE);

        $result = ApiModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = ApiModel::create()->data($data)->save()){
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
                $request_params = [];
                foreach ($data['request_params_field'] as $k=>$v){
                    $request_params[] = [
                        'field'=>$data['request_params_field'][$k],
                        'type'=>$data['request_params_type'][$k],
                        'required'=>$data['request_params_required'][$k],
                        'desc'=>$data['request_params_desc'][$k],
                    ];
                }
                $data['request_params'] = json_encode($request_params,JSON_UNESCAPED_UNICODE);
                $response_params = [];
                foreach ($data['response_params_field'] as $k=>$v){
                    $response_params[] = [
                        'field'=>$data['response_params_field'][$k],
                        'type'=>$data['response_params_type'][$k],
                        'desc'=>$data['response_params_desc'][$k],
                    ];
                }
                $data['response_params'] = json_encode($response_params,JSON_UNESCAPED_UNICODE);
                $data['update_time'] = date('Y-m-d H:i:s');
                $ApiModel = ApiModel::create();
                $result = $ApiModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($ApiModel->where('id',$this->param['id'])->update($data)) {
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
            if( ApiModel::create()->where('id',$ids,'in')->destroy()){
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
        $model  = ApiModel::create();

        $list = $model->withTotalCount()->field('id as value, name')->order('sort', 'asc')->all();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }

    //更新单个字段
    public function updateField(){
        if (!empty($this->param['id'])) {
           $data[$this->param['field']] = $this->param['value'];
            if(ApiModel::create()->where('id',$this->param['id'])->update($data)){
                $this->AjaxJson(1, ['status' => 0], '更新成功');
                return false;
            }else{
                $this->AjaxJson(0,$this->param, '更新失败');
                return false;
            }
        } else {
            $this->AjaxJson(0, ['status' => 0], 'ID不存在');
        }
    }

}

