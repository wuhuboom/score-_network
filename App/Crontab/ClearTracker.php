<?php

namespace App\Crontab;

use App\Model\TrackerPointModel;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class ClearTracker extends AbstractCronTask
{

    public static function getRule(): string
    {
        return '30 1 * * *';
    }

    public static function getTaskName(): string
    {
        return  'ClearTracker';
    }

    function run(int $taskId, int $workerIndex)
    {
       var_dump("计划任务：{$taskId},清除15天之前的访问记录");
       $time = time()-3600*24*30;
       TrackerPointModel::create()->where('startTime',$time,'<=')->destroy();
        var_dump('清除成功');

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}