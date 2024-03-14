<?php
namespace App\HttpController\Admin;

use App\HttpController\Common\DatabaseBackupOrm;
use App\Log\LogHandler;
use EasySwoole\Http\Message\Status;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * Class MYSQL数据备份/还原
 * Create With Automatic Generator
 */
class Database extends \App\HttpController\Admin\Base
{
    /**
     * 数据表列表
     */
    public function lists(){
        $dataBackup = new DatabaseBackupOrm();
        $res = $dataBackup->databaseTables();
        $list = $res['data'];
        $total = count($list);;
        $this->writeJson(Status::CODE_OK, ['total'=>$total,'list'=>$list], 'OK');
        return true;
    }
    /**
     * 备份数据表
     * @param  array tables
     */
    public function backup(){
        if(!empty($this->param['tables'])){
            $tables = is_array($this->param['tables'])?$this->param['tables']:explode(',',$this->param['tables']);
            $filter_tables = ['td_admins_handle_log','td_admins_handle_log_result','td_api_tracker_point_list_result','td_api_tracker_point_list','td_business_handle_log','td_business_handle_log_result','td_api_tracker_point_list_202306','td_api_tracker_point_list_202305'];
            foreach ($tables as $k=>$v){
                if(in_array($v,$filter_tables)){
                    unset($tables[$k]);
                }
            }
            $tables = array_values($tables);
            $dataBackup = new DatabaseBackupOrm();
            $res = $dataBackup->backup($tables);
            $log_contents =date('Y-m-d H:i:s').'：'.$res['msg'];
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'database_backup');
            $this->AjaxJson($res['status'],$res['data'],$res['msg']);return false;
        }else{
            $this->AjaxJson(0, [], '请选择要备份的数据表');return false;
        }

    }
    /**
     * 还原数据表
     * @param  array tables
     */
    public function restore(){
        if(!empty($this->param['file'])){
            $dataBackup = new DatabaseBackupOrm();
            $path = '/public/database/backup/'.$this->param['file'];
            $res = $dataBackup->restore($path);
            $this->AjaxJson($res['status'],$res['data'],$res['msg']);return false;
        }else{
            $this->AjaxJson(0, [], '请选择要备份的数据表');return false;
        }

    }

    /**
     * @return void
     */
    public function backupLists(){
        $dir = EASYSWOOLE_ROOT.'/public/database/backup/';
        $data = scandir($dir);
        foreach ($data as $value) {
            //判断如果是文件夹则进入下一次循环
            if (is_dir($dir . "/" . $value)) {
                continue;
            }
            if ($value != '.' && $value != '..') {
                $row  = [
                    'name'=>$value,
                    'size'=>round(filesize($dir . "/" . $value)/1024/1024,3),
                    'create_time'=>date('Y-m-d H:i:s',filectime($dir . "/" . $value)),
                ];
                $files[]  = $row;
            }
        }

        $create_time = array_column($files,'create_time');
        array_multisort($create_time,SORT_DESC,$files);
        $this->writeJson(200, ['total'=>count($files),'list'=>$files], 'ok');
    }

    /**
     * 删除备份
     */
    public function delBackup(){
        if(!empty($this->param['files'])){
            $files = is_array($this->param['files'])?$this->param['files']:explode(',',$this->param['files']);
            foreach ($files as $file){
                if(file_exists(EASYSWOOLE_ROOT.'/public/database/backup/'.$file)){
                    @unlink(EASYSWOOLE_ROOT.'/public/database/backup/'.$file);
                }else{
                    $this->AjaxJson(0, [], '文件不存在：'.EASYSWOOLE_ROOT.'/public/database/backup/'.$file);return false;
                }
            }
            $this->AjaxJson(1, $files, '删除成功');return false;
        }else{
            $this->AjaxJson(0, [], '请选择要删除的备份');return false;
        }

    }

    /**
     * 下载备份
     */
    public function downloadBackup(){
        if(empty($this->param['file'])){
            $this->AjaxJson(0, [], '请选择要下载的备份');return false;
        }
        $contents = file_get_contents(EASYSWOOLE_ROOT.'/public/database/backup/'.$this->param['file']);
        $this->response()->withHeader('Content-type', 'application/octet-stream');
        $this->response()->withHeader('Content-Transfer-Encodin', 'Binary');
        $this->response()->withHeader('Content-Disposition', 'attachment;filename=' . $this->param['file']);
        $this->response()->withStatus(200);
        $this->response()->write($contents);
    }

    /**
     * 获取表字段信息
     */
    public function getTableFields(){
        if(empty($this->param['table_name'])){
            $this->AjaxJson(0, [], '请选择指定数据表');return false;
        }
        $sql = 'SELECT * FROM ';
        $sql .= 'information_schema.COLUMNS ';
        $sql .= 'WHERE ';
        $sql .= "table_name = '{$this->param['table_name']}'";//AND table_schema = 'bwc'

        $queryBuild = new QueryBuilder();
        $queryBuild->raw($sql);   // 支持参数绑定 第二个参数非必传
        $result = DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();        // 第三个参数 connectionName 指定使用的
        $this->writeJson(Status::CODE_OK, ['total'=>count($result),'list'=>$result], 'OK');
        return true;

    }
}

