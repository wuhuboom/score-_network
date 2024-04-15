<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\StatsTrendService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class StatsTrend implements TaskInterface
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
        try {
            $event_id = $data['event_id'];
            if($event_id){
                $result = \App\HttpController\Common\BetsApi::getStatsTrend($event_id);
            }
            if($result['success']==1&&$result['results']){
                $save_data = [];
                foreach ($result['results'] as $field=>$value){
                    $save_data[$field]  = json_encode($value, JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_NUMERIC_CHECK);
                }
                $save_data['event_id'] = $event_id;
                $save_data['update_time'] =date('Y-m-d H:i:s');
                $log_contents = "【{$event_id}】".json_encode($save_data,JSON_UNESCAPED_UNICODE);
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'StatsTrend');
                if($res = Service::create()->getOne(['event_id'=>$event_id])){
                    Service::create()->update($res['id'],$save_data );
                }else{
                    $save_data['create_time'] =date('Y-m-d H:i:s');
                    $id = Service::create()->save($save_data);
                    $log_contents = $id;
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'StatsTrend');
                }
            }
        }catch (\Throwable $e){
            $log_contents = $e->getMessage();
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TaskError');
        }
    }

    public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // 异常处理
    }
}