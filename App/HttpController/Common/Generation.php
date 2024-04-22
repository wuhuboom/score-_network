<?php
namespace App\HttpController\Common;

use App\Model\AuthRuleModel;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * @todo    自动生成代码
 * @version    v1.0.0
 */
class Generation
{
    //定义一个空的数组
    static public $treeList = array();

    /**
     * 检测表是否存在
     * @param $table_name 表名
     * @return void
     */
    static public function tableExists($table_name){
        $queryBuild = new QueryBuilder();
        // 支持参数绑定 第二个参数非必传
        $queryBuild->raw("show tables");
        //第二个参数 raw  指定true，表示执行原生sql 第三个参数 connectionName 指定使用的连接名，默认 default
        $data       = DbManager::getInstance()->query($queryBuild, true)->getResult();
        $config = Config::getInstance()->getConf('MYSQL');
        $prefix = $config['prefix'] ?? 'td_';   //表前缀
        $value  = 'Tables_in_' . $config['database'];//获取数据列表二维数组的key Tables_in_+数据库名称
        $tables = array_column($data, $value); //获取所有表名
        $table_name = $prefix . $table_name;
        if (in_array($table_name, $tables)) {
            return true;
        }
        return false;
    }



    /**
     * 生成模型文件
     * @return void
     */
    static public function generateModel($model_name,$table_name,$columns){

        if(file_exists(EASYSWOOLE_ROOT.'/App/Model/'.$model_name.'Model.php')){
            return "{$model_name}文件已存在！";
        }

        //表字段
        $table_field = 'id,create_time,update_time';
        // 验证规则
        $validate_rules = [];
        // 验证错误消息提示
        $validate_messages = [];
        // 验证字段的别名
        $validate_alias = [];
        //验证规则类型
        $validate_type = [];

        foreach ($columns as $value) {
            if(!in_array($value['Field'],['id','create_time','update_time'])){
                $table_field .= ",`{$value['Field']}`";
                $validate_rules[$value['Field']] = 'required|notEmpty';
                $validate_messages[$value['Field']] = $value['Field'] . '必须';
                $validate_alias[$value['Field']] = $value['Field'];
                $validate_type['add'][]  = $value['Field'];
                $validate_type['edit'][]  = $value['Field'];
            }
        }
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateModel.php');
        $data  = vsprintf($template,[$model_name,$table_name,$table_field,var_export($validate_rules, true),var_export($validate_messages, true),var_export($validate_alias, true),var_export($validate_type, true)]);
        file_put_contents(EASYSWOOLE_ROOT.'/App/Model/'.$model_name.'Model.php',$data);
        return true;
    }

    /**
     * 生成Dao文件
     * @return void
     */
    static public function generateDao($module_name){
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateDao.php');
        $data  = vsprintf($template,[$module_name,$module_name,$module_name]);
        if(file_exists(EASYSWOOLE_ROOT.'/App/Dao/'.$module_name.'Dao.php')){
            return "{$module_name}Dao文件已存在！";
        }
        file_put_contents(EASYSWOOLE_ROOT.'/App/Dao/'.$module_name.'Dao.php',$data);
        return true;
    }
    /**
     * 生成Service文件
     * @return void
     */
    static public function generateService($module_name){
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateService.php');
        $data  = str_replace('Template',$module_name,$template);

        if(file_exists(EASYSWOOLE_ROOT.'/App/Service/'.$module_name.'Service.php')){
            return "{$module_name}Service文件已存在！";
        }
        file_put_contents(EASYSWOOLE_ROOT.'/App/Service/'.$module_name.'Service.php',$data);
        return $template;
    }

    /**
     * 生成控制器Controller文件
     * @return void
     */
    static public function generateController($module_name,$columns){
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateController.php');
        $search_where = '';
        if($columns){
            foreach ($columns as $k=>$value){
                if(!in_array($value['Field'],['id','create_time','update_time'])&&strpos('varchar', $value['Type'])){
                    $search_where .= ' if(!empty($this->param["'.$value['Field'].'"])) {  $where["'.$value['Field'].'"] = ["%{'.'$this->param["'.$value['Field'].'"]'.'}%", "like"];}'.PHP_EOL;
                }
            }
        }
        $data  = vsprintf($template,[$module_name,$module_name,$search_where]);
        if(file_exists(EASYSWOOLE_ROOT.'/App/HttpController/Admin/'.$module_name.'.php')){
            return "{$module_name}文件已存在！";
        }
        file_put_contents(EASYSWOOLE_ROOT.'/App/HttpController/Admin/'.$module_name.'.php',$data);
        return true;
    }
    /**
     * 生成后台模板视图文件
     * @return void
     */
    static public function generateViewHtml($module,$module_name,$table_name,$columns){
        $table_name = str_replace('td_','',$table_name);
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateView.html');
        $template = str_replace('ModuleName',$module_name,$template);
        $template = str_replace('Module',$module,$template);
        $field = '';
        if($columns){
            foreach ($columns as $k=>$value){
                if(!in_array($value['Field'],['id','create_time','update_time'])){
                    if (strpos(strtolower($value['Type']), ('varchar')) !== false || strpos(strtolower($value['Type']), 'int') !== false) {
                        $field .= "{ title: '{$value['Field']}', field: '{$value['Field']}',minWidth: 110}," . PHP_EOL;
                    }
                }
            }
        }

        $data  = vsprintf($template,[$field]);
        if(is_dir(EASYSWOOLE_ROOT.'/public/nepadmin/views/admin/'.$table_name)){
            if(file_exists(EASYSWOOLE_ROOT.'/public/nepadmin/views/'.$table_name.'/list.html')){
                return "/public/nepadmin/views/admin/{$table_name}/list.html'文件已存在！";
            }
        }else{
            mkdir(EASYSWOOLE_ROOT.'/public/nepadmin/views/'.$table_name, 0755);
        }

        file_put_contents(EASYSWOOLE_ROOT.'/public/nepadmin/views/'.$table_name.'/list.html',$data);
        return $table_name;
    }

    /**
     * 生成菜单和权限
     * @return void
     */
    static public function generateAuthMenu($menu_name,$table_name,$auth_rule_id){
        $table_name = str_replace('td_','',$table_name);
        $className = Generation::underscoreToCamelCase($table_name);
        $pid = Generation::addAuthMenu($menu_name,"/{$table_name}/list",$auth_rule_id,2,1);
        $class_method = get_class_methods ( "\\App\\HttpController\\Admin\\$className" );
        $methods = [
            'lists'  => "获取{$menu_name}列表",
            'add'    => "新增{$menu_name}",
            'edit'   => "更新{$menu_name}",
            'del'    => "删除{$menu_name}",
            'update' => "请求API获取{$menu_name}数据"
        ];
        if(is_array($class_method)){
            foreach ($class_method as $method_name){
                if(in_array($method_name,$methods)){
                    $auth_rule_name = vfprintf($methods[$method_name],$menu_name);
                    $auth_rule_method = 'Admin/'.$className.'/'.$method_name;
                    Generation::addAuthMenu($auth_rule_name,$auth_rule_method,$pid,3,0);
                }

            }
        }
        return true;
    }
    //生成菜单
    static public function addAuthMenu($name,$method,$pid,$type=2,$is_menu=0){
        $sort = 0;
        if($pid){
            $sort = AuthRuleModel::create()->where('pid',$pid)->order('sort','desc')->val('sort')??0;
        }
        $save = [
            'name'=>$name,
            'method'=>$method,
            'pid'=>$pid,
            'type'=>$type,
            'is_menu'=>$is_menu,
            'sort'=>$sort+1,
            'update_time'=>date('Y-m-d H:i:s'),
            'create_time'=>date('Y-m-d H:i:s')
        ];
        if($id = AuthRuleModel::create()->where('method',$method)->val('id')){
            unset($save['sort']);
            unset($save['update_time']);
            AuthRuleModel::create()->where('id',$id)->update($save);
        }else{
            $id = AuthRuleModel::create()->data($save)->save();
        }
       return $id;

    }
    //下划线转驼峰 hello_world 转HelloWorld
	static public function underscoreToCamelCase($string) {
		$pattern = '/_(.)/';
		$replacement = function ($match) {
			return strtoupper($match[1]);
		};
		return ucfirst(lcfirst(preg_replace_callback($pattern, $replacement, $string)));
	}




}

