<?php

namespace App\Crontab;

use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class UpcomingEvents extends AbstractCronTask
{
	//获取今日比赛赛程
    public static function getRule(): string
    {
        return '5 0 * * *'; //* /1 * * * *
    }

    public static function getTaskName(): string
    {
        return  'UpcomingEvents';
    }

    function run(int $taskId, int $workerIndex)
    {
	    $day = 15;
	    for ($i=0;$i<$day;$i++){
		    $date = date('Ymd',time()+24*3600*$i);
		    $log_contents = "获取【{$date}】的赛程记录开始";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabUpcomingEvents');
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $res = $task->sync(new \App\Task\Upcoming(['day'=>$date]));
		    $log_contents = "获取【{$date}】的赛程记录结束";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabUpcomingEvents');
	    }


    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}