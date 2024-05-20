<?php
namespace App\Process;

use App\Log\LogHandler;
use App\Service\EndedService;
use App\Service\InplayService;
use App\Service\OddsService;
use App\Service\UpcomingService;
use App\Service\ViewService;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\ORM\DbManager;

//自动更新赛程赔率
class SystemGenerateCompetitionDetails extends AbstractProcess
{

	protected function run($arg)
	{
		$pid = $this->getPid();
		// TODO: Implement run() method.
		go(function ()use ($pid){

			while (1){
				try {
					$data = UpcomingService::create()->where(['time'=>[time(),'<='],'time_status'=>0,'is_generate'=>1])->find();
					if($data){
						$data['event_id'] = $data['id'];
						$data['time_status'] = 1;
						$data['sport_id'] = 1;
						$data['ss'] = $data['ss']??'0-0';
						$data['scores'] = [];
						$data['time'] = strtotime($data['time']);
						$data['timer'] =  [];
						$data['stats'] =  $data['stats']??[];
						$data['is_generate'] = 1;
						$data['create_time'] = date('Y-m-d H:i:s');
						$data['update_time'] = date('Y-m-d H:i:s');

						if($insert_id =  InplayService::create()->save($data)){
							UpcomingService::create()->update($data['id'],['time_status'=>1]);
							ViewService::create()->save($data);
							$odds = [
								'event_id'=>$data['id'],
								'odds'=>$data['odds']
							];
							OddsService::create()->save($odds);
							$log_contents = '自定义比赛正在进行生成成功：' . json_encode($data,JSON_UNESCAPED_UNICODE);
							LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'GenerateCompetition');
						}else{
							$log_contents = '自定义比赛正在进行生成失败：' . json_encode($data,JSON_UNESCAPED_UNICODE);
							LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'GenerateCompetition');
						}

					}

					\co::sleep(3);     	//每3秒获取一次
				}catch (\Throwable $e){
					$log_contents = "自定义比赛正在进行自定义进程错误：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'GenerateCompetition');
					if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
						$log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'GenerateCompetition');
						\co::sleep(1);
						$path = EASYSWOOLE_ROOT;
						$cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
						$log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'GenerateCompetition');
						shell_exec($cmd);
					}
				}

			}

		});
	}

	public function getEnded($day,$league_id='',$team_id='',$cc=''){
		$log_contents = "开始获取{$day}的记录";
		LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
		$page =1;
		$sport_id =1;
		$skip_esports = '';
		$data = \App\HttpController\Common\BetsApi::getEnded($sport_id,$page,$league_id,$team_id,$cc,$day,$skip_esports);
		if(!empty($data['results'])){
			foreach ($data['results'] as $k=>$v){
				$save_data = $v;
				foreach ($save_data as $field=>$value){
					$save_data[$field]  = $value??'';
				}
				$save_data['create_time'] =date('Y-m-d H:i:s');
				$save_data['update_time'] =date('Y-m-d H:i:s');

				if($res = Service::create()->getOne(['id'=>$save_data['id']])){
					Service::create()->update($res['id'],$save_data );
					$log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
				}else{
					Service::create()->save($save_data);
					$log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
				}
			}
			if($data['pager']['total']>$data['pager']['per_page']){
				$page_num = ceil($data['pager']['total']/$data['pager']['per_page']);
				$page++;
				for($page;$page<=$page_num;$page++){
					$data = \App\HttpController\Common\BetsApi::getEnded($sport_id,$page,$league_id,$team_id,$cc,$day,$skip_esports);
					if(!empty($data['results'])){
						foreach ($data['results'] as $k=>$v){
							$save_data = $v;
							foreach ($save_data as $field=>$value){
								$save_data[$field]  = $value??'';
							}
							$save_data['create_time'] =date('Y-m-d H:i:s');
							$save_data['update_time'] =date('Y-m-d H:i:s');

							if($res = Service::create()->getOne(['id'=>$save_data['id']])){
								Service::create()->update($res['id'],$save_data );
								$log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
								LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
							}else{
								Service::create()->save($save_data);
								$log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
								LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
							}
						}
					}
				}
			}
		}else{
			$log_contents = "请求{$day}的记录无数据".json_encode($data,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
		}
		$log_contents = "结束获取{$day}的记录";
		LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'EndedEvents');
	}
}