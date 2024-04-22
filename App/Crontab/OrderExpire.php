<?php
namespace App\Crontab;

use App\Log\LogHandler;
use App\Service\OrderService;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class OrderExpire extends AbstractCronTask
{
    //每日凌晨0点 订单自动过期
    public static function getRule(): string
    {
        return '*/1 * * * *';
        //return '0 0 * * *';
    }

    public static function getTaskName(): string
    {
        return  'OrderExpire';
    }

    function run(int $taskId, int $workerIndex)
    {
        //订单自动过期，
        go(function (){
            $datetime = date('Y-m-d 00:00:00',time());
            $log_contents = '订单自动过期开始';
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_expire');
            $where['status'] = [1,'='];
            $where['expire_time'] = [$datetime,'<'];
            OrderService::create()->update($where,['status'=>0,'update_time'=>date('Y-m-d H:i:s')]);
            $log_contents = '订单自动过期结束';
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_expire');
        });

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        $log_contents = '订单自动过期异常'.$throwable->getMessage();
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_expire');
    }
}