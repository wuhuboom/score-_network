<?php
namespace App\HttpController\Common;

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
     * 生成控制器文件
     * @return void
     */
    static public function generateController(){

    }

    /**
     * 生成模型文件
     * @return void
     */
    static public function generateModel($model_name,$table_name,$table_field,$validate_rules,$validate_messages,$validate_alias,$validate_type){
        $template = file_get_contents(EASYSWOOLE_ROOT.'/App/Template/TemplateModel.php');
        $data  = vsprintf($template,[$model_name,$table_name,$table_field,$validate_rules,$validate_messages,$validate_alias,$validate_type]);
        if(file_exists(EASYSWOOLE_ROOT.'/App/Model/'.$model_name.'.php')){
            return false;
        }
        file_put_contents(EASYSWOOLE_ROOT.'/App/Model/'.$model_name.'.php',$data);
        return true;
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

