<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;
use App\HttpController\Common\Regex;
use App\Model\AuthGroupAccessModel;
use App\Model\AuthGroupModel;
use App\Model\AuthRuleModel;
use App\Model\UserModel;
use App\Model\AuthModel;
use App\Model\OrderModel;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class Users
 * Create With Automatic Generator
 */
class Auth extends \App\HttpController\Admin\Base
{
    /**
     * 功能权限分组
     */
    public function getAuthGroupLists(){
        try {
            $page = (int)($this->param['page']??1);
            $limit = (int)($this->param['limit']??20);
            $model = AuthGroupModel::create();
            if(!empty($this->param['method'])){ $model->where('method like "%'.$this->param['method'].'%"'); }
            if(!empty($this->param['name'])){ $model->where('name like "%'.$this->param['name'].'%"'); }

            $field = "*";
            $list = $model->withTotalCount()
                          ->order('id', 'ASC')
                          ->field($field)->limit($limit * ($page - 1), $limit)->all();
            $total = $model->lastQueryResult()->getTotalCount();;
            foreach ($list as $k=>$v){
                if($v['auth_rule_ids']){
                    $list[$k]['rules'] = AuthRuleModel::create()->where('id',$v['auth_rule_ids'],'in')->where('pid',0)->column('name');
                    $list[$k]['rules'] = is_array($list[$k]['rules'])?implode(',',$list[$k]['rules']):[];
                }
            }
            $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
            return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
            return false;
        }

    }
    /**
     * 新增权限分组
     */
    public function addAuthGroup(){
        $data = $this->param;
        $data['create_time'] = time();
        $data['update_time'] = time();
        if(AuthGroupModel::create()->where('name',$data['name'])->get()){
            $this->AjaxJson(0, ['status'=>0], '分组已存在');return false;
        }
        $result = AuthGroupModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = AuthGroupModel::create()->data($data)->save()){
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
     * 更新权限分组
     */
    public function editAuthGroup(){
        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;
                $data['create_time'] = time();
                $data['update_time'] = time();
                if (AuthGroupModel::create()->where('name', $data['name'])->where('id', $data['id'], '<>')->get()) {
                    $this->AjaxJson(0, ['status' => 0], '分组已存在');
                    return false;
                }
                $result = AuthGroupModel::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                $rule_ids = explode(',',$data['auth_rule_ids']);
                $pid = AuthRuleModel::create()->where('id',$rule_ids,'in')->column('pid');
                if($pid){
                    $parent_id = AuthRuleModel::create()->where('id',$pid,'in')->column('pid');
                    if($parent_id){
                        $pid = array_merge($pid, $parent_id);
                    }
                }
                $auth_rule_ids = array_map('intval', array_unique(array_merge($pid, $rule_ids)));
                sort($auth_rule_ids);
                $data['auth_rule_ids'] = implode(',', $auth_rule_ids);
                if (AuthGroupModel::create()->update($data, ['id' => $this->param['id']])) {
                    $uids = AuthGroupAccessModel::create()->where('group_id',$this->param['id'])->column('uid');
                    foreach ($uids as $uid){
                        \App\HttpController\Common\Auth::setAdminRules($uid);
                    }
                    $this->AjaxJson(1, [$pid,$auth_rule_ids,$uids], '更新成功');
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
     * 删除权限分组
     */
    public function delAuthGroup(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( AuthGroupModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除认成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的权限分组');
        }
        return false;
    }
    /**
     * 获取所有权限分组
     */
    public function getAllAuthGroup(){
        $model = AuthGroupModel::create();
        $field = "id as value, name";
        $order = ['id','asc'];
        $list = $model->order($order[0], $order[1])->field($field)->all();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }

    /**
     * 功能权限列表
     */
    public function getAuthRuleLists(){
        $param = $this->request()->getRequestParam();
        $page = (int)($param['page']??1);
        $limit = (int)($param['limit']??20);
        $model = new AuthRuleModel();

        if(!empty($this->param['type'])){ $model->where('r.type',$this->param['type']); }
        if(!empty($this->param['method'])){ $model->where('r.method like "%'.$this->param['method'].'%"'); }
        if(!empty($this->param['name'])){ $model->where('r.name like "%'.$this->param['name'].'%"'); }
        if(!empty($this->param['parent'])){ $model->where('p.name like "%'.$this->param['parent'].'%"'); }
        $field = "r.*,p.name as parent";
        $list = $model->withTotalCount()->alias('r')
                        ->join('td_auth_rule p','p.id=r.pid','LEFT')
                      ->order('r.pid,r.type,r.sort,r.id', 'ASC')
                      ->field($field)->limit($limit * ($page - 1), $limit)->all();
//        foreach ($list as $k=>$v){
//            $list[$k]['parent'] = AuthRuleModel::create()->where('id',$v['pid'])->val('name');
//        }
        $total = $model->lastQueryResult()->getTotalCount();;
        $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
        return true;
    }
    /**
     * 新增功能权限
     */
    public function addAuthRule(){
        $data = $this->param;
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] =date('Y-m-d H:i:s');
        if(AuthRuleModel::create()->where('method',$data['method'])->get()){
            $this->AjaxJson(0, ['status'=>0], '路由已存在');return false;
        }
        $result = AuthRuleModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = AuthRuleModel::create()->data($data)->save()){
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
     * 更新功能权限
     */
    public function editAuthRule(){
        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;

                $data['is_menu'] = $data['is_menu']==1?1:2;
                $data['create_time'] = date('Y-m-d H:i:s');
                $data['update_time'] =date('Y-m-d H:i:s');
                if (AuthRuleModel::create()->where('method', $data['method'])->where('id', $data['id'], '<>')->get()) {
                    $this->AjaxJson(0, ['status' => 0], '路由已存在');
                    return false;
                }
                $result = AuthRuleModel::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if (AuthRuleModel::create()->update($data, ['id' => $this->param['id']])) {
                    $this->AjaxJson(1, ['status' => 1], '更新成功');
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
    //排序
    public function sort(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (AuthRuleModel::create()->update($data, ['id' => $this->param['id']])) {
                    $this->AjaxJson(1, ['status' => 1], '更新成功');
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
     * 自动生成通用子权限
     */
    public function generateAuthRule(){
        if(!empty($this->param['id'])){
            $module = $this->param['module'];
            $name = $this->param['name'];
            $auth_rule_list = ['lists'=>"获取%s列表",'add'=>"新增%s",'edit'=>"编辑%s",'del'=>"删除%s",'all'=>"全部%s筛选"];
            $sort = 1;
            foreach ($auth_rule_list as $k=>$v){
                $save = [
                    'is_menu'=>2,
                    'name'=>sprintf($v, $name),
                    'method'=>"Admin/{$module}/{$k}",
                    'type'=>3,
                    'status'=>1,
                    'sort'=>$sort,
                    'pid'=>$this->param['id'],
                    'is_validate'=>$k=='all'?0:1,
                    'update_time'=>date('Y-m-d H:i:s'),
                    'create_time'=>date('Y-m-d H:i:s')
                ];
                if(!AuthRuleModel::create()->where('method',$save['method'])->find()){
                    AuthRuleModel::create()->data($save)->save();
                }else{
                    AuthRuleModel::create()->where('method',$save['method'])->update($save);
                }
                $sort++;
            }
            $this->AjaxJson(1, ['status'=>1], '自动生成模块通用子权限成功');return false;
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '功能ID必须');
        }
    }
    /**
     * 删除规则
     */
    public function delAuthRule(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( AuthRuleModel::create()->where('id',$ids,'in')->destroy()){
                AuthRuleModel::create()->where('pid',$ids,'in')->destroy();
                $this->AjaxJson(1, ['status'=>1], '删除认成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的规则');
        }
        return false;
    }
    /**
     * 获取所有规则
     */
    public function getAllAuthRule(){
        $model = AuthRuleModel::create();
        $field = "id as value,CONCAT(name,'【',method,'】') as name,pid,type";
        $order = ['type,sort,id','asc'];
        $list = $model->order($order[0], $order[1])->field($field)->select();
        $auth_rule_ids = $this->param['auth_rule_ids']??[];
        $index = [];
        $pid_index = [];
        foreach ($list as $k=>$v){
            if($v['pid']==0){
                $data[$v['value']]['name'] = $v['name'];
                $data[$v['value']]['value'] = $v['value'];

            }else if($v['type']==2){
                if($v['pid']>0){
                    if(!isset($index[$v['pid']]['index'])){
                        $index[$v['pid']]['index']=0;
                    }
                    $row_index= $index[$v['pid']]['index'];
                    $data[$v['pid']]['children'][$row_index] = $v;
                    $pid_index[$v['value']] =['pid'=>$v['pid'],'index'=>$row_index];
                    $index[$v['pid']]['index']++;
                }else{
                    $data[$v['value']]['name'] = $v['name'];
                    $data[$v['value']]['value'] = $v['value'];
                }

            }else{
                if(in_array($v['value'],$auth_rule_ids)){
                    $v['selected'] = true;
                }
                if(!empty($data[$pid_index[$v['pid']]['pid']]['children'][$pid_index[$v['pid']]['index']])){
                    $data[$pid_index[$v['pid']]['pid']]['children'][$pid_index[$v['pid']]['index']]['children'][] = $v;
                }else{
                    $data[$v['pid']]['children'][] = $v;
                }

            }
        }

        //$data = json_decode("[{name:'销售员',value:-1,disabled:true,children:[{name:'张三1',value:1,selected:true,children:[]},{name:'李四1',value:2,selected:true},{name:'王五1',value:3,disabled:true},]},{name:'奖品',value:-2,children:[{name:'奖品3',value:-3,children:[{name:'苹果3',value:14,selected:true},{name:'香蕉3',value:15},{name:'葡萄3',value:16},]},{name:'苹果2',value:4,selected:true,disabled:true},{name:'香蕉2',value:5},{name:'葡萄2',value:6},]},]",1);
        $this->AjaxJson(1, array_values($data), 'success');
        return true;
    }
//    /**
//     * 获取所有规则
//     */
//    public function getAllAuthRule(){
//
//        $model = AuthRuleModel::create();
//        $field = "id as value,CONCAT(name,'【',method,'】') as name,pid";
//        $order = ['sort,id','asc'];
//        $list = $model->order($order[0], $order[1])->field($field)->select();
//        $data =[];
//        foreach ($list as $k=>$v){
//            if($v['pid']==0){
//                $data[$v['value']]['name'] = $v['name'];
//                $data[$v['value']]['value'] = $v['value'];
//            }else{
//                $data[$v['pid']]['children'][] = $v;
//            }
//        }
//
//        $this->AjaxJson(1, array_values($data), 'success');
//        return true;
//    }
    /**
     * 获取所有规则
     */
    public function getParentAuthRule(){
        $list = AuthRuleModel::create()->where('type<=2')->field('id,id as value,name,method,icon,pid as parent_id,type,sort')->order('type,sort','asc')->select();
        $list = Common::getChildren($list,0);
        $this->AjaxJson(1, $list, 'success'); return false;
        $model = AuthRuleModel::create();
        $field = "id as value,name";
        $model->where('pid',0);
        $order = ['sort,id','asc'];
        $list = $model->order($order[0], $order[1])->field($field)->all();
        $this->AjaxJson(1, $list, 'success');
        return true;
    }


}

