<?php


namespace App\Process;

use App\HttpController\Common\Common;
use App\HttpController\Common\Qiniu;
use App\Log\LogHandler;
use App\Model\FileManagementModel;
use EasySwoole\Component\Process\AbstractProcess;

class FileSyncToQiniu extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){
            LogHandler::getInstance()->log('开始同步文件至七牛云', LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
            while (1){
                try {
                    $system = Common::getSystem();
                    if($system['qiniu']['is_open']==1){
                        $list = FileManagementModel::create()->where('is_oss',0)->field('id,file_name,file_url,file_path')->select();
                        foreach ($list as $v){
                            $res = Qiniu::putFile(EASYSWOOLE_ROOT.$v['file_url'],ltrim($v['file_path'], '/'),$v['file_name']);
                            if($res&&!empty($res['key'])){
                                FileManagementModel::create()->where('id',$v['id'])->update(['is_oss'=>1,'hash'=>$res['hash'],'update_time'=>date('Y-m-d H:i:s')]);
                                LogHandler::getInstance()->log($v['file_url'].'同步至七牛云成功', LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                            }else{
                                LogHandler::getInstance()->log($v['file_url'].'同步至七牛云失败'.json_encode($res,JSON_UNESCAPED_UNICODE), LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                            }
                        }
                    }else{
                        LogHandler::getInstance()->log('未开启七牛云服务，暂停5分钟！', 'file_management');
                        \co::sleep(3000);
                    }

                }catch (\Throwable $e){
                    LogHandler::getInstance()->log($e->getMessage(), LogHandler::getInstance()::LOG_LEVEL_INFO, 'file_management');
                    if (strrpos(strtoupper($e->getMessage()), 'SQLSTATE') !== false) {
                        $log_contents = date('Y-m-d H:i:s') . '：' . "数据库连接异常：{$e->getMessage()}";
                        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'SQLSTATE');
                        \co::sleep(1);
                        $path         = EASYSWOOLE_ROOT;
                        $cmd          = "cd {$path};php easyswoole process kill --pid={$pid} -f";
                        $log_contents = date('Y-m-d H:i:s') . '：' . "自定义进程重启：{$cmd}";
                        LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'SQLSTATE');
                        shell_exec($cmd);
                    }
                }
                \co::sleep(5);
            }

        });
    }
}