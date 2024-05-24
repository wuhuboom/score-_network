<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Model\EndedModel;
use App\Model\HistoryModel;
use App\Service\EndedService;
use App\Service\ViewService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class History implements TaskInterface
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
		$time = strtotime($data['time']);
		$event_id = $data['event_id'];
		$home_id = $data['home_id'];
		$away_id = $data['away_id'];
		$model = EndedModel::create();
		$h2h = $model->field('league,home,away,time,ss,time_status')
			->where('time_status', 3, '=')
			->where('time', $time, '<')
			->where(" (( home->'$.id'='{$home_id}' and  away->'$.id'='{$away_id}' ) or( home->'$.id'='{$away_id}' and  away->'$.id'='{$home_id}' ))")
			->page(1, 10)
			->order('time', 'DESC')
			->select();
		foreach ($h2h as $k=>$v){
			$h2h[$k]['time'] = strtotime($v['time']);
		}
		$log_contents = '获取对阵历史：'.$model->lastQuery()->getLastPrepareQuery();
		LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'History');
		$home = $model->field('league,home,away,time,ss,time_status')
			->where('time_status', 3, '=')
			->where('time', $time, '<')
			->where(" (( home->'$.id'='{$home_id}' and  away->'$.id'<>'{$away_id}' ) or( home->'$.id'<>'{$away_id}' and  away->'$.id'='{$home_id}' ))")
			->page(1, 10)
			->order('time', 'DESC')
			->select();
		foreach ($home as $k=>$v){
			$home[$k]['time'] = strtotime($v['time']);
		}
		$log_contents = '获取主队历史：'.$model->lastQuery()->getLastPrepareQuery();
		LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'History');
		$away = $model->field('league,home,away,time,ss,time_status')
			->where('time_status', 3, '=')
			->where('time', $time, '<')
			->where(" (( home->'$.id'<>'{$home_id}' and  away->'$.id'='{$away_id}' ) or( home->'$.id'='{$away_id}' and  away->'$.id'<>'{$home_id}' ))")
			->page(1, 10)
			->order('time', 'DESC')
			->select();
		foreach ($away as $k=>$v){
			$away[$k]['time'] = strtotime($v['time']);
		}
		$log_contents = '获取客队历史：'.$model->lastQuery()->getLastPrepareQuery();
		LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'History');
		$history = [
			'event_id'=>$event_id,
			'h2h'=>$list??$h2h,
			'home'=>$home,
			'away'=>$away,
			'create_time'=>date('Y-m-d H:i:s'),
		];
		if(HistoryModel::create()->where('event_id',$event_id)->find()){
			$insert_id = HistoryModel::create()->where('event_id',$event_id)->update($history);
			$log_contents = '更新自定义历史记录：'.$insert_id.json_encode($data,JSON_UNESCAPED_UNICODE).json_encode($history,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'History');
		}else{
			$insert_id = HistoryModel::create()->data($history)->save();
			$log_contents = '新增自定义历史记录：'.$insert_id.json_encode($data,JSON_UNESCAPED_UNICODE).json_encode($history,JSON_UNESCAPED_UNICODE);
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'History');
		}

	}

	public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
	{
		// 异常处理
	}

}