<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\LeagueTableService as Service;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class LeagueTable implements TaskInterface
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
            $league_ids = $data['league_ids'];
            foreach ($league_ids as $league_id){
                try {
                    $result = \App\HttpController\Common\BetsApi::getLeagueTable($league_id);

                    if($result['success']==1&&$result['results']){
                        foreach ($result['results'] as $k=>$v){
                            $save_data = $v;
                            $log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
                            foreach ($save_data as $field=>$value){
                                $save_data[$field]  = json_encode($value,JSON_UNESCAPED_UNICODE);
                            }
                            $save_data['league_id'] = $league_id;
                            $save_data['update_time'] =date('Y-m-d H:i:s');

                            if($res = Service::create()->getOne(['league_id'=>$league_id])){
                                Service::create()->update($res['id'],$save_data );
                            }else{
                                $save_data['create_time'] =date('Y-m-d H:i:s');
                                $id = Service::create()->save($save_data);

                            }
                        }
                    }
                }catch (\Throwable $e){
                    $log_contents = $e->getMessage();
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TaskError');
                }


                \co::sleep(2);
            }

        });
    }

    public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // 异常处理
    }
}