<?php
namespace App\Process;

use App\Log\LogHandler;
use App\Service\TeamService;
use EasySwoole\Component\Process\AbstractProcess;


//自动更新正在进行的比赛
class GetTeamLogo extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){
	        $team_id = 0;
            while (1){
                try {
                    \co::sleep(3);
                    $log_contents = "每3秒获取一个队伍图标开始";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Team_Logo');

	                $where = ['image_id'=>[0,'>'],'logo'=>['','='],'id'=>[$team_id,'>']];
	                $team = TeamService::create()->getLists($where,'*',1,1,'id asc')['list'][0]??'';
	                if($team){
		                $team_id= $team['id']+1;
		                $image_url = "https://assets.b365api.com/images/team/b/{$team['image_id']}.png";
		                $localPath = EASYSWOOLE_ROOT."/public/uploads/team_logo/{$team['id']}.png"; // 本地保存路径
		                $logo = "/public/uploads/country/{$team['id']}.png"; // 本地保存路径
		                $imageData = file_get_contents($image_url);

		                if ($imageData !== false) {
			                $saved = file_put_contents($localPath, $imageData);
			                if ($saved !== false) {
				                TeamService::create()->update($team['id'],['logo'=>$logo]);
				                $log_contents = "图片已保存至: " . $localPath;
				                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Team_Logo');

			                } else {
				                $log_contents =  "保存图片失败";;
				                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Team_Logo');
			                }
		                } else {

			                $log_contents =  "获取图片失败:{$team_id}_".$image_url;;
			                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Team_Logo');
		                }
	                }


                    $log_contents = "每3秒获取一个队伍图标结束";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Team_Logo');
                }catch (\Throwable $e){
                    $log_contents = "每3秒获取一个队伍图标开始自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
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