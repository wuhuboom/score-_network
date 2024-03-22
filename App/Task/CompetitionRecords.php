<?php

namespace App\Task;

use App\Log\LogHandler;

use App\Model\TeamModel;
use App\Service\TeamMembersService as Service;
use App\Service\TeamService;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class CompetitionRecords implements TaskInterface
{
	protected $data;

	public function __construct($data)
	{
		// 保存投递过来的数据
		$this->data = $data;
	}

	public function run(int $taskId, int $workerIndex)
	{
		$data = $this->data;
		go(function ()use ($data){
			$team_id = 0;
			$team = TeamModel::create()->field('id,name')->order('id','DESC')->find();
			$log_contents = '获取球队成员：'.json_encode($team,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamMembers');
			while ($team){
				try {
					$team_id = $team['id'];
					$result = \App\HttpController\Common\BetsApi::getTeamMembers($team_id);
					if($result['success']==1&&$result['results']){
						foreach ($result['results'] as $k=>$v){
							$save_data = $v;
							$log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
							LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamMembers');
							foreach ($save_data as $field=>$value){
								$save_data[$field]  = $value??'';
							}
							$save_data['team_id'] = $team_id;
							$save_data['update_time'] =date('Y-m-d H:i:s');

							if($res = Service::create()->getOne(['team_id'=>$team_id])){
								Service::create()->update($res['id'],$save_data );
							}else{
								$save_data['create_time'] =date('Y-m-d H:i:s');
								$id = Service::create()->save($save_data);
								$log_contents = $id;
								LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamMembers');
							}
						}
					}
					//
					$team = TeamModel::create()->where('id',$team_id,'<')->field('id,name')->order('id','DESC')->find();
					$log_contents = '获取球队成员：'.json_encode($team,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TeamMembers');
				}catch (\Throwable $e){
					$log_contents = $e->getMessage();
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TaskError');
				}
				\co::sleep(0.1);
			}
		});
	}

	public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
	{
		// 异常处理
	}
}