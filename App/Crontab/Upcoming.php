<?php

namespace App\Crontab;

use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class Upcoming extends AbstractCronTask
{
	//获取今日比赛赛程
    public static function getRule(): string
    {
        return '45 1 * * *'; //* /1 * * * *
    }

    public static function getTaskName(): string
    {
        return  'UpcomingEvents';
    }

    function run(int $taskId, int $workerIndex)
    {
	    $date = date('Ymd');
	    $log_contents = "获取【{$date}】的赛程记录开始";
	    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabUpcomingEvents');
	    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
	    $res = $task->sync(new \App\Task\Upcoming(['day'=>$date]));
	    $log_contents = "获取【{$date}】的赛程记录开始";
	    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabUpcomingEvents');

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}