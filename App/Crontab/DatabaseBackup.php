<?php

namespace App\Crontab;

use App\HttpController\Common\DatabaseBackupOrm;
use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class DatabaseBackup extends AbstractCronTask
{
    //每日凌晨0点 恢复活动名额
    public static function getRule(): string
    {
        return '10 4 * * *';
    }

    public static function getTaskName(): string
    {
        return  'DatabaseBackup';
    }

    function run(int $taskId, int $workerIndex)
    {
        go(function (){
            $log_contents = date('Y-m-d H:i:s').'：开始备份数据库';
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'database_backup');
            $dataBackup = new DatabaseBackupOrm();
            $res = $dataBackup->databaseTables();

            $tables = array_column($res['data'],'table_name');
            //过滤不需要备份的表
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
            $log_contents = date('Y-m-d H:i:s').'：结束备份数据库';
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'database_backup');
        });


    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}