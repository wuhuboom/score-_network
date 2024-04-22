<?php

namespace App\HttpController\Common;

use App\Model\AuthGroupAccessModel;
use App\Model\AuthGroupModel;
use App\Model\AuthRuleModel;
use App\Model\BusinessAuthGroupAccessModel;
use App\Model\BusinessAuthGroupModel;
use App\Model\BusinessAuthRuleModel;
use EasySwoole\FastCache\Cache;

/**
 * @todo    权限类
 * @version    v1.0.0
 */
class Auth
{
    //定义一个空的数组
    static public $treeList = array();
    //更新权限名称
    static public function updateRuleName(){
        $field = "r.*,p.name as parent";
        $method = ['lists'=>'列表','edit'=>'编辑','add'=>'新增','del'=>'删除','doStatus'=>'状态设置','all'=>'全部','upload'=>'上传图片','uploadVideo'=>'上传视频'];
        $list = AuthRuleModel::create()->withTotalCount()->alias('r')->where('r.type',3)
                             ->join('td_auth_rule p','p.id=r.pid','LEFT')
                             ->order('r.type,id', 'asc')
                             ->field($field)->select();
        foreach ($list as $k=>$v){
            $name = str_replace('管理','',$v['parent']);
            foreach ($method as $key=>$item){
                if(strpos($v['method'],$key) !== false){
                    $name = $item.$name;
                    AuthRuleModel::create()->where('id',$v['id'])->update(['name'=>$name]);
                    break;
                }
            }

        }
        return true;
    }
    //根据后台文件生成后台权限列表
    static public function createAuthRule(){
        $public = ['Auths','Base','Chart'];
        $public_method = ['all','upload','tree'];
        $base_method  =get_class_methods ( \App\HttpController\Admin\Base::class );
        $api  = [];
        $files = \App\HttpController\Common\Auth::getListFiles(EASYSWOOLE_ROOT.'/App/HttpController/Admin');
        foreach ($files as $className){
            if(!in_array($className,$public)){
                $class_method = get_class_methods ( "\\App\\HttpController\\Admin\\$className" );
                $parent = [
                    'is_validate'=>0,
                    'name'=>$className,
                    'method'=>$className,
                    'pid'=>0,
                    'type'=>2,
                    'create_time'=>date('Y-m-d H:i:s'),
                    'update_time'=>date('Y-m-d H:i:s'),
                ];
                $pid = AuthRuleModel::create()->where('method',$className)->val('id');
                if(empty($pid)){
                    $pid = AuthRuleModel::create()->data($parent)->save();
                }
                if(is_array($class_method)){
                    foreach ($class_method as $method_name){
                        if(!in_array($method_name,$base_method)){
                            $api[] = [
                                'is_validate' => in_array($method_name,$public_method)?0:1,
                                'name'        => 'Admin/' . $className . '/' . $method_name,
                                'method'      => 'Admin/' . $className . '/' . $method_name,
                                'pid'         => $pid,
                                'type'        => 3,
                                'create_time' => date('Y-m-d H:i:s'),
                                'update_time' => date('Y-m-d H:i:s'),
                            ];

                        }
                    }
                }
            }
        }
        foreach ($api as $k=>$v){
            if(!AuthRuleModel::create()->where('method',$v['method'])->find()){
                AuthRuleModel::create()->data($v)->save();
            }
        }

        return $api;
    }
    //获取指定目录下的所有文件 path路径  type返回文件类型：1文件名不带后缀 0文件名待后缀
    static public function getListFiles($path, $type = 1)
    {
        $files = [];
        //扫描目录内的所有目录和文件并返回数组
        $data = scandir($path);
        foreach ($data as $value) {
            //判断如果是文件夹则进入下一次循环
            if (is_dir($path . "/" . $value)) {
                continue;
            }
            if ($value != '.' && $value != '..') {
                $pathInfo = pathinfo($value);
                $files[]  = $pathInfo['filename'];
            }
        }
        return $files;
    }
    /**
     * 获取所有功能权限列表
     * @return Array
     */
    public static function getAllAuthRuleLists()
    {
        $list = Cache::getInstance()->get('auth_rule_lists');
        if (empty($list)) {
            $list = AuthRuleModel::create()
                                 ->field('id, name,id as value,parent_id')
                                 ->select();
            Cache::getInstance()->set('auth_rule_lists', $list,600);
        }
        return $list;
    }

    /**
     * 获取所有功能权限树形列表
     * @return Array
     */
    public static function getAllAuthRuleTree()
    {
        $list = Cache::getInstance()->get('auth_rule_tree');
        if (empty($list)) {
            $model = AuthRuleModel::create();
            $field = "id as value,CONCAT(name,'【',method,'】') as name,pid";
            $order = ['sort,id','asc'];
            $auth_rule_list = $model->order($order[0], $order[1])->field($field)->select();
            $list =[];
            foreach ($auth_rule_list as $k=>$v){
                if($v['pid']==0){
                    $list[$v['value']]['name'] = $v['name'];
                    $list[$v['value']]['value'] = $v['value'];
                }else{
                    $list[$v['pid']]['children'][] = $v;
                }
            }
            Cache::getInstance()->set('auth_rule_tree', $list,600);
        }
        return $list;
    }

    /**
     * 获取所有功能权限 第一级列表
     * @return Array
     */
    public static function getAllAuthRuleParent()
    {
        $list = Cache::getInstance()->get('auth_rule_parent');
        if (empty($list)) {
            $list = AuthRuleModel::create()
                                 ->where('pid',0)
                                 ->field('id,name,id as value')
                                 ->select();
            Cache::getInstance()->set('auth_rule_lists', $list,600);
        }
        return $list;
    }

    /**
     * 获取当前用户的权限列表
     */
    public static function getAdminRules($uid){
        $rules = Cache::getInstance()->get('auth_rules_'.$uid);
        if(empty($rules)){
            $rules = self::setAdminRules($uid);
        }
        return $rules;
    }
    /**
     * 缓存管理员权限
     */
    public static function setAdminRules($uid){
        $model = AuthGroupAccessModel::create();
        $group_ids = $model->where('uid',$uid)->column('group_id');

        $rules_ids =AuthGroupModel::create()->where('id',$group_ids?$group_ids:[0],'in')->column('auth_rule_ids');
        $rules_ids =$rules_ids?explode(',',implode(',',$rules_ids)):[0];
        $rules = AuthRuleModel::create()->where('id',$rules_ids??[0],'in')->column('method');
        if($rules){
            foreach ($rules as &$v){
                $v= strtolower($v);
            }
        }
        Cache::getInstance()->set('auth_rules_'.$uid,$rules??[],500);
        return $rules;
//        $rules_ids = AuthGroupModel::create()
//                                   ->alias('g')
//                                   ->join('td_auth_group_access c','c.group_id','LEFT')
//                                   ->where('c.uid',$uid)
//                                   ->column('auth_rule_ids');
//        $rules_ids =$rules_ids?explode(',',implode(',',$rules_ids)):[0];
//        $rules = AuthRuleModel::create()->where('id',$rules_ids??[0],'in')->column('method');
//        Cache::getInstance()->set('auth_rules_'.$uid,$rules??[],600);
//        return $rules;
    }

    /**
     * 获取当前用户的权限列表
     */
    public static function getBusinessRules($uid){
        $rules =[]; Cache::getInstance()->get('business_auth_rules_'.$uid);
        if(empty($rules)){
            $rules = self::setBusinessRules($uid);
        }
        return $rules;
    }
    /**
     * 缓存管理员权限
     */
    public static function setBusinessRules($uid){
        $model = BusinessAuthGroupAccessModel::create();
        $group_ids = $model->where('uid',$uid)->column('group_id');

        $rules_ids =BusinessAuthGroupModel::create()->where('id',$group_ids?$group_ids:[0],'in')->column('auth_rule_ids');
        $rules_ids =$rules_ids?explode(',',implode(',',$rules_ids)):[0];
        $rules = BusinessAuthRuleModel::create()->where('id',$rules_ids??[0],'in')->column('method');
        if($rules){
            foreach ($rules as &$v){
                $v= strtolower($v);
            }
        }
        Cache::getInstance()->set('business_auth_rules_'.$uid,$rules??[],500);
        return $rules;

    }




}

