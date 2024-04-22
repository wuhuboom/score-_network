<?php

namespace App\Process;

use EasySwoole\FastCache\Cache;
use EasySwoole\FastCache\Job;
use EasySwoole\Component\Process\AbstractProcess;

class FastCacheQueueProcess extends AbstractProcess
{
    protected function run($arg)
    {

        go(function (){
            while (1) {
                $job = Cache::getInstance()->getJob('tracker_queue');// Job对象或者null
                if ($job === null) {
                    echo "没有任务\n";
                } else {
                    // 执行业务逻辑
                    var_dump($job);
                    // 执行完了要删除或者重发，否则超时会自动重发
                    Cache::getInstance()->deleteJob($job);
                }
            }
            \co::sleep(1);
        });
    }
}