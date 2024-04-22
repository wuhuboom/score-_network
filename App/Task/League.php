<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\LeagueService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class League implements TaskInterface
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
            $page = 1;
            $data = \App\HttpController\Common\BetsApi::getLeague(1,$page);
            if($data['results']){
                foreach ($data['results'] as $k=>$v){
                    $save_data = $v;
                    foreach ($save_data as $k=>$v){
                        $save_data[$k]  = $v??'';
                    }
                    $save_data['create_time'] =date('Y-m-d H:i:s');
                    $save_data['update_time'] =date('Y-m-d H:i:s');

                    if($res = Service::create()->getOne(['cc'=>$save_data['cc']??'','name'=>$save_data['name']])){
                        Service::create()->update($res['id'],$save_data );
                        $log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'League');
                    }else{
                        Service::create()->save($save_data);
                        $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'League');
                    }
                }
                if($data['pager']['total']>$data['pager']['per_page']){
                    $page_num = ceil($data['pager']['total']/$data['pager']['per_page']);
                    $page++;
                    for($page;$page<=$page_num;$page++){
                        $data = \App\HttpController\Common\BetsApi::getLeague(1,$page);
                        if($data['results']){
                            foreach ($data['results'] as $k=>$v){
                                $save_data = $v;
                                foreach ($save_data as $k=>$v){
                                    $save_data[$k]  = $v??'';
                                }
                                $save_data['create_time'] =date('Y-m-d H:i:s');
                                $save_data['update_time'] =date('Y-m-d H:i:s');

                                if($league = Service::create()->getOne(['cc'=>$save_data['cc']??'','name'=>$save_data['name']])){
                                    Service::create()->update($save_data['id'],$save_data );
                                    $log_contents = '更新数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'League');
                                }else{
                                    Service::create()->save($save_data);
                                    $log_contents = '新增数据：'.json_encode($save_data,JSON_UNESCAPED_UNICODE);
                                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'League');
                                }
                            }
                        }
                        \co::sleep(0.5);
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