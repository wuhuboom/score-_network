<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\EndedService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class Ended implements TaskInterface
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
            $page=1;
            $data = \App\HttpController\Common\BetsApi::getEnded(1,$page);
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
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Ended');
                    }else{
                        Service::create()->save($save_data);
                        $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Ended');
                    }
                }
                if($data['pager']['total']>$data['pager']['per_page']){
                    $page_num = ceil($data['pager']['total']/$data['pager']['per_page']);
                    $page++;
                    for($page;$page<=$page_num;$page++){
                        $data = \App\HttpController\Common\BetsApi::getEnded(1,$page);
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
                                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Ended');
                                }else{
                                    Service::create()->save($save_data);
                                    $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Ended');
                                }
                            }
                        }
	                    \co::sleep(1);
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