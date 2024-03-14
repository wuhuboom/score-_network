<?php

namespace App\Crontab;

use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class ClearSession extends AbstractCronTask
{

    public static function getRule(): string
    {
        return '30 1 * * *'; //* /1 * * * *
    }

    public static function getTaskName(): string
    {
        return  'ClearSession';
    }

    function run(int $taskId, int $workerIndex)
    {
       var_dump("删除过期session 15天之前的");
       $expire_time = time()-3600*24*15;
       $dir = EASYSWOOLE_ROOT.'/Temp/Session';
        //扫描目录内的所有目录和文件并返回数组
        $files = scandir($dir);
        foreach ($files as $file){
            if(is_file($dir . "/" . $file)){
                $file_create_time = filectime($dir . "/" . $file);
                if($file_create_time<$expire_time){
                    @unlink($dir . "/" . $file);
                }
            }
        }
    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}