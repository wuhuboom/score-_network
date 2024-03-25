<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\InplayService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;
use Jaeger\Cache;

class Inplay implements TaskInterface
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
            $data = \App\HttpController\Common\BetsApi::getInplay(1);
            if($data['results']){
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
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Inplay');
                    }else{
                        Service::create()->save($save_data);
                        $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Inplay');
                    }
                }

            }

        });
    }

    public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // 异常处理
    }
}