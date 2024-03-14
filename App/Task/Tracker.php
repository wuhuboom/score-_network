<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Model\TrackerPointModel;
use App\Model\TrackerPointResultModel;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class Tracker implements TaskInterface
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
            $tracker_id  = TrackerPointModel::create()->data($data, false)->save();
            TrackerPointResultModel::create()->data(['tracker_id'=>$tracker_id,'data'=>$data['data']])->save();
        });
    }

    public function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        // 异常处理
    }
}