<?php
namespace App\Process;

use App\Log\LogHandler;
use App\Service\EndedService;
use EasySwoole\Component\Process\AbstractProcess;

//自动更新即将开始的比赛
class Ended extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){
            while (1){
                try {
                	//20160901
	                // 两个日期字符串
	                $date1 = "2016-09-01";
	                //$date2 = date('Y-m-d');
	                $last_time = EndedService::create()->getLists([],'time',1,1,'time asc')[0]['time']??time();
	                $date2 = date('Y-m-d',$last_time);
					$day =round((strtotime($date2)-strtotime($date1))/3600*24);
	                for ($i=1;$i<=$day;$i++){
		                $date = date('Ymd',time()-24*3600*$i);
		                $log_contents = "获取【{$date}】已结束的比赛记录开始";
		                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
		                $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		                $res = $task->sync(new \App\Task\Ended(['day'=>$date]));
		                $log_contents = "获取【{$date}】已结束的比赛记录结束";
		                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
	                }
	                \co::sleep(3);
                }catch (\Throwable $e){
                    $log_contents = "获取结束的比赛数据自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                    if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
                        $log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                        \co::sleep(1);
                        $path = EASYSWOOLE_ROOT;
                        $cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
                        $log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
                        shell_exec($cmd);
                    }
                }

            }

        });
    }
}