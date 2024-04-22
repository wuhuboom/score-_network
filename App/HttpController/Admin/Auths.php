<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Log\LogHandler;
use App\Model\AuthGroupAccessModel;
use App\Model\AuthGroupModel;
use App\Model\AuthRuleModel;

/**
 * Class SiamAuth
 * Create With Automatic Generator
 */
class Auths extends Base
{
    public function get_menu()
    {
        $menu[] = [
            "auth_rules" => "/index",
            "auth_name"  => "控制台",
            "auth_icon"  => "layui-icon-home"
        ];
        $AuthRuleModel = AuthRuleModel::create();
        if($this->uid!=1){
            $model = AuthGroupAccessModel::create();
            $group_ids = $model->where('uid',$this->uid)->column('group_id');
            $rules_ids =AuthGroupModel::create()->where('id',$group_ids?$group_ids:[0],'in')->column('auth_rule_ids');
            $rules_ids =$rules_ids?explode(',',implode(',',$rules_ids)):[0];
            $AuthRuleModel->where('id',$rules_ids??[0],'in');
        }
        $list = $AuthRuleModel->where('type<=3')->where('is_menu',1)->field('id,name,method,icon,pid as parent_id,type,sort')->order('type,sort','asc')->select();
        $list = Common::getChild($list,0);

        foreach ($list as $k=>$v){
            $data =[
                'auth_rules'=>$v['method'],
                'auth_name'=>$v['name'],
                'auth_icon'=>$v['icon'],
            ];
            $childs =[];
            foreach ($v['child'] as $item){

                if($item['child']){
                    foreach ($item['child'] as $three){
                        $three_childs[] =   [ "auth_name"  =>$three['name'], "auth_rules" => $three['method'],"auth_icon"  => "", "auth_type"  => 2];
                    }
                    $childs[] =   [ "auth_name"  =>$item['name'],"auth_icon"  => "", "auth_type"  => 3,'childs'=>$three_childs];
                }else{
                    $childs[] =   [ "auth_name"  =>$item['name'], "auth_rules" => $item['method'],"auth_icon"  => "", "auth_type"  => 2];
                }

            }
            $data['childs'] = $childs;
            $menu[] = $data;
        }

        $this->writeJson(200, $menu, "success");
        return true;
    }

    //获取API列表
    public function getApiList()
    {
        $log_contents = date('Y-m-d H:i:s').'：开始获取api列表';
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'get_api_list');
        $public = ['Base'];
        $base_method  =get_class_methods ( \App\HttpController\Admin\Base::class );
        $api  = [];
        $files = \App\HttpController\Common\Auth::getListFiles(EASYSWOOLE_ROOT.'/App/HttpController/Admin');
        $rules =  \App\HttpController\Common\Auth::getAdminRules($this->uid);
        $rules = empty($rules)?[]:$rules;
        $rules = array_merge($rules,$this->basicAction);
        $rules = array_map('strtolower',$rules);
        $log_contents = date('Y-m-d H:i:s').'：已获取api列表';
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'get_api_list');
        foreach ($files as $className){
            if(!in_array($className,$public)){
                $class_method = get_class_methods ( "\\App\\HttpController\\Admin\\$className" );
                if(is_array($class_method)){
                    foreach ($class_method as $method_name){
                        if($this->uid==1){
                            $api[$className.ucfirst($method_name)] = $className.'/'.$method_name;

                        }else if(!in_array($method_name,$base_method)){
                            if($rules){
                                $search =strtolower('Admin/'.$className.'/'.$method_name);
                                if(in_array($search,$rules)){
                                    $api[$className.ucfirst($method_name)] = $className.'/'.$method_name;
                                }else{
                                  //  $api[$className.ucfirst($method_name)] = $search;
                                }
                            }else{
                               // $api[$className.ucfirst($method_name)] = $className.'/'.$method_name;
                                //$api[$className.ucfirst($method_name)] = '没有权限/Admin/'.$className.'/'.$method_name;
                            }
                        }
                    }
                }
            }
        }

        $list = [
            'Index'             => 'index/index',
            'login'             => 'login/login',
            'updatePassword'    => 'login/updatePassword',
            'getMenu'           => 'auths/get_menu',
            //系统配置
            'getSystem'         => 'system/getSystem',
            'saveSystem'        => 'system/saveSystem',
            //链路最终
            'getTracker'        => 'tracker/lists',

        ];
        $list = array_merge($list,$api);
        $log_contents = date('Y-m-d H:i:s').'：结束获取api列表';
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'get_api_list');
        $this->writeJson(200,$list,$this->uid);

    }
}

