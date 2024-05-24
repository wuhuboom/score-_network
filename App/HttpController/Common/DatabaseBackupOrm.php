<?php
namespace App\HttpController\Common;

use App\Log\LogHandler;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * 数据库备份还原类
 */
class DatabaseBackupOrm
{
    private $tables = array();
    private $config;
    private $begin; //开始时间
    private $database_name; //开始时间
    /**
     * 架构方法
     * @param array $config
     */
    public function __construct()
    {
        $this->begin  = microtime(true);
        $this->config = DbManager::getInstance()->getConnection()->getConfig();
    }

    /**
     * 获取所有表
     * @return array
     */
    public function databaseTables(){
        $sql  = "select table_schema as 'database_name',table_name,table_rows,truncate(data_length/1024/1024, 2) as 'data_size',truncate(index_length/1024/1024, 2) as 'index_size'from information_schema.tables where table_schema='" . $this->config->getDatabase() . "' order by table_name desc;";
        $list = $this->query($sql);
        return $this->returnData(1,'ok',$list);
    }

    /**
     * 备份
     * @param array $tables
     * @return bool
     */
    public function backup($tables = array()){
        ini_set('memory_limit','4086M');
        $ddl  = array();      //存储表定义语句的数组
        $data = array();      //存储数据的数组
        $this->setTables($tables);

        if (!empty($this->tables)) {
            foreach ($this->tables as $table) {
                $ddl[]  = $this->getDDL($table);
                $data[] = $this->getData($table);
            }
            //开始写入
            return $this->writeToFile($this->tables, $ddl, $data);
        } else {
            return $this->returnData(0,'数据库中没有表');

        }
    }

    /**
     * 还原备份
     */
    public function restore($path = '')
    {
        $path = EASYSWOOLE_ROOT.$path;
        if (!file_exists($path)) {
            return $this->returnData(0,'SQL文件不存在!',$path);;
        }else {
            $sql = $this->parseSQL($path);
            try {
                $list_sql = explode(';', $sql);
                $res      = [];
                foreach ($list_sql as $v){
                    if(!empty($v)){
                        $res[] = $this->query($v.';');
                    }
                }
                return $this->returnData(1,'还原成功!花费时间'. (microtime(true) - $this->begin) . 'ms',$res);
            } catch (\Throwable $e) {
                return $this->returnData(0,$e->getMessage(),$sql);
            }
        }
    }

    /**
     * 设置要备份的表
     * @param array $tables
     */
    private function setTables($tables = array())
    {
        if (!empty($tables) && is_array($tables)) {
            //备份指定表
            $this->tables = $tables;
        } else {
            //备份全部表
            $this->tables = $this->getTables();
        }
    }

    /**
     * 查询
     * @param string $sql
     * @return mixed
     */
    private function query($sql = '')
    {
        $queryBuild = new QueryBuilder();
        $queryBuild->raw($sql);   // 支持参数绑定 第二个参数非必传
        $result = DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();        // 第三个参数 connectionName 指定使用的
        return $result;
    }

    /**
     * 获取全部表
     * @return array
     */
    private function getTables(){
        $sql    = "show tables;";
        $list   = $this->query($sql);
        $tables = array();
        foreach ($list as $value) { //$value = TABELS_IN_DATABASENAME
            $tables[] = array_values($value)[0];
        }
        return $tables;
    }

    /**
     * 获取表定义语句
     * @param string $table
     * @return mixed
     */
    private function getDDL($table = ''){
        $sql = "SHOW CREATE TABLE `{$table}`";
        $res = $this->query($sql);
        $ddl =$res[0]['Create Table'] . ';';
        return $ddl;
    }

    /**
     * 获取表数据
     * @param string $table
     * @return mixed
     */
    private function getData($table = ''){
        $log_contents = date('Y-m-d H:i:s').'：开始备份数据表:'.$table;
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'database_backup');
        $sql     = "SHOW COLUMNS FROM `{$table}`";
        $list    = $this->query($sql);
        $columns = ''; //字段
        $query   = ''; //需要返回的SQL
        foreach ($list as $value) {
            $columns .= "`{$value['Field']}`,";
        }
        $columns = substr($columns, 0, -1);
        $data = $this->query("SELECT * FROM `{$table}`");
        foreach ($data as $value) {
            $dataSql = '';
            foreach ($value as $v) {
                $dataSql .= "'{$v}',";
            }
            $dataSql = substr($dataSql, 0, -1);
            $query   .= "INSERT INTO `{$table}` ({$columns}) VALUES ({$dataSql});\r\n";
        }
        $log_contents = date('Y-m-d H:i:s').'：结束备份数据表:'.$table;
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'database_backup');
        return $query;
    }

    /**
     * 写入文件
     * @param array $tables
     * @param array $ddl
     * @param array $data
     */
    private function writeToFile($tables = array(), $ddl = array(), $data = array())
    {
        $str = "/*\r\nMySQL Database Backup Tools\r\n";
        $str .= "Server:{$this->config->getHost()}:{$this->config->getPort()}\r\n";
        $str .= "Database:{$this->config->getDatabase()}\r\n";
        $str .= "Data:" . date('Y-m-d H:i:s', time()) . "\r\n*/\r\n";
        $str .= "SET FOREIGN_KEY_CHECKS=0;\r\n";
        $i = 0;
        foreach ($tables as $table)
        {
            $str .= "-- ----------------------------\r\n";
            $str .= "-- Table structure for {$table}\r\n";
            $str .= "-- ----------------------------\r\n";
            $str .= "DROP TABLE IF EXISTS `{$table}`;\r\n";
            $str .= $ddl[$i] . "\r\n";
            $str .= "-- ----------------------------\r\n";
            $str .= "-- Records of {$table}\r\n";
            $str .= "-- ----------------------------\r\n";
            $str .= $data[$i] . "\r\n";
            $i++;
        }
        $file_name = '/public/database/backup/'.date('YmdHis').rand(1000,9999).'.sql';
        $file = EASYSWOOLE_ROOT.$file_name; // 指定文件名

        // 打开文件，如果文件不存在，将创建它
        $handle = fopen($file, 'w'); // 'w' 表示写入模式

        // 检查文件是否成功打开
        if ($handle === false) {
            return $this->returnData(0,'无法创建或打开文件!',[EASYSWOOLE_ROOT.$file_name,$str]);
        }
        // 写入内容到文件
        if (fwrite($handle, $str) === false) {
            return $this->returnData(0,'无法写入数据到文件!',[EASYSWOOLE_ROOT.$file_name,$str]);
        }
        fclose($handle); // 关闭文件
        return $this->returnData(1,'备份成功!花费时间' . (microtime(true) - $this->begin) . 'ms',['file_path'=>$file_name]);
        $res = file_put_contents(EASYSWOOLE_ROOT.$file_name, $str);
        if($res){
            return $this->returnData(1,'备份成功!花费时间' . (microtime(true) - $this->begin) . 'ms',['file_path'=>$file_name]);
        }else{
            return $this->returnData(0,'备份失败!',[$res,EASYSWOOLE_ROOT.$file_name,$str]);
        }
    }


    /**
     * 解析SQL文件为SQL语句数组
     * @param string $path
     * @return array|mixed|string
     */
    private function parseSQL($path = '')
    {
        $sql = file_get_contents($path);
        $sql = explode("\r\n", $sql);
        //先消除--注释
        $sql = array_filter($sql, function ($data) {
            if (empty($data) || preg_match('/^--.*/', $data)) {
                return false;
            } else {
                return true;
            }
        });
        $sql = implode('', $sql);
        //删除/**/注释
        $sql = preg_replace('/\/\*.*\*\//', '', $sql);
        return $sql;
    }

    /**
     * 返回数据
     * @return array
     */
    protected function returnData($status,$msg,$data=[]){
        return [
            'status' => $status,
            'msg'    => $msg,
            'data'   => $data
        ];
    }


}