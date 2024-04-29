<?php
namespace App\Crontab;

use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class Ended extends AbstractCronTask
{
	//每5分钟更新今日的比赛记录
    public static function getRule(): string
    {
        return '*/5 * * * *'; //* /1 * * * *
    }

    public static function getTaskName(): string
    {
        return  'TodayEndedEvents';
    }

    function run(int $taskId, int $workerIndex)
    {
        $date = date('Ymd',time());
        $log_contents = "获取【{$date}】的比赛记录开始";
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabTodayEndedEvents');
        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
        $res = $task->sync(new \App\Task\Ended(['day'=>$date]));
        $log_contents = "获取【{$date}】的比赛记录开始";
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'CrontabTodayEndedEvents');

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}