<?php
namespace App\Task;

use App\Log\LogHandler;
use App\Service\ViewService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class View implements TaskInterface
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
        $event_id = $data['event_id'];
        $data = \App\HttpController\Common\BetsApi::getView($event_id);
        if ($data['results']) {
            foreach ($data['results'] as $k => $v) {
                $save_data = $v;
                foreach ($save_data as $field => $value) {
                    $save_data[$field] = $value ?? '';
                }
                $save_data['create_time'] = date('Y-m-d H:i:s');
                $save_data['update_time'] = date('Y-m-d H:i:s');
                $log_contents = '更新比赛数据：' . json_encode($save_data, JSON_UNESCAPED_UNICODE);
                LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'View');
                if ($res = Service::create()->getOne(['id' => $save_data['id']])) {
                    Service::create()->update($res['id'], $save_data);
                } else {
                    Service::create()->save($save_data);
                }
            }
        }
	}

	public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
	{
		// 异常处理
	}

}