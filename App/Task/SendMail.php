<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Model\MailModel;
use App\Model\UserModel;
use App\Service\MailService;
use EasySwoole\Task\AbstractInterface\TaskInterface;
use Jaeger\Cache;

class SendMail implements TaskInterface
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
			$user_ids = UserModel::create()->column('id');
			foreach ($user_ids as $k=>$v){
				$save = [];
				$save['title']    = $data['title'];
				$save['contents']    = $data['contents'];
				$save['user_id']    = $v;
				$save['admin_id']    =  $data['admin_id']??1;
				$save['create_time'] = date('Y-m-d H:i:s');
				$save['update_time'] = date('Y-m-d H:i:s');
				MailService::create()->save($save);
				$log_contents = "发送站内信：{$v}";
				LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Mail');
			}
        });
    }

    public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // 异常处理
    }
}