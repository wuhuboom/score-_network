<?php

namespace App\Process;

use App\Log\LogHandler;
use App\Model\OrderModel;
use App\Model\ShopActivityModel;
use App\Model\TrackerPointModel;
use App\Utility\MyQueue;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;
use EasySwoole\Queue\Job;

class QueueProcess extends AbstractProcess
{
    protected function run($arg)
    {
        go(function (){
            MyQueue::getInstance()->consumer()->listen(function (Job $job){
                $log_contents = date('Y-m-d H:i:s').'：队列消费';
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'tracker_process');
                $data = json_decode($job->getJobData(),1);
                $tracker_id = DbManager::getInstance()->invoke(function ($client) use ($data){
                    $tracker_id =         TrackerPointModel::invoke($client)->data($data, false)->save();
                    $log_contents = date('Y-m-d H:i:s').'：访问记录插入成功'.$tracker_id;
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'tracker_process');
                    return $tracker_id;
                });
            });
        });
    }
}