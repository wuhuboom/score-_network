<?php
namespace App\Process;

use App\Log\LogHandler;
use EasySwoole\Component\Process\AbstractProcess;


//自动更新正在进行的比赛
class Inplay extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){
            while (1){

                try {
                    \co::sleep(60);
                    $log_contents = "每5分钟自动更新正在比赛数据开始";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Inplay');
                    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
                    $task->async(new \App\Task\Inplay([]));
                    $log_contents = "每5分钟自动更新正在比赛数据结束";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Inplay');
                }catch (\Throwable $e){
                    $log_contents = "正在进行的比赛数据自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'SQLSTATE');
                    if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
                        $log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'SQLSTATE');
                        \co::sleep(1);
                        $path = EASYSWOOLE_ROOT;
                        $cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
                        $log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'SQLSTATE');
                        shell_exec($cmd);
                    }

                }

            }

        });
    }
}