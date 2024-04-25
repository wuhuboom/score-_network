<?php

namespace App\Crontab;

use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class Ended extends AbstractCronTask
{
	//自动获取N日前的比赛记录
    public static function getRule(): string
    {
        return '45 1 * * *'; //* /1 * * * *
    }

    public static function getTaskName(): string
    {
        return  'EndedEvents';
    }

    function run(int $taskId, int $workerIndex)
    {
    	$day = 5;
    	for ($i=1;$i<=$day;$i++){
		    $date = date('Ymd',time()-24*3600*$i);
		    $log_contents = "获取【{$date}】的比赛记录开始";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabEndedEvents');
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $res = $task->sync(new \App\Task\Ended(['day'=>$date]));
		    $log_contents = "获取【{$date}】的比赛记录开始";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabEndedEvents');
	    }

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}