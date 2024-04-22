<?php

namespace App\Crontab;

use App\Log\LogHandler;
use App\Model\OrderSettlementModel;
use App\Model\UserModel;
use App\Service\DataStatisticsService;
use App\Service\UserCashOutService;
use App\Service\UserRechargeService;
use App\Service\UserService;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\Mysqli\QueryBuilder;

class DailyDataStatistics extends AbstractCronTask
{
    //每日数据统计
    public static function getRule(): string
    {
        return '*/5 * * * *';
    }

    public static function getTaskName(): string
    {
        return  'DailyDataStatistics';
    }

    function run(int $taskId, int $workerIndex)
    {

        go(function (){
            //只更新最近5天的数据
            for($i=0;$i<15;$i++){
                $date = date('Y-m-d',time()-24*3600*$i);
                $start_time = $date.' 00:00:00';
                $end_time = $date.' 23:59:59';
                $save['date'] = $date;
                $save['register_num'] = UserService::create()->where(['create_time'=>[[$start_time,$end_time],'between']])->count()??0;
                $save['active_num'] = UserService::create()->where(['is_active'=>1,'active_time'=>[[$start_time,$end_time],'between']])->count()??0;
                if($save['register_num']>0){
                    $save['active_ratio']  = $save['active_num']/$save['register_num'];
                    $save['active_ratio'] = round($save['active_ratio'],2);
                }else{
                    $save['active_ratio'] = 0;
                }
                //$save['active_ratio'] = $save['register_num']>0?round($save['active_num']/$save['register_num'],2):0;
                $save['recharge_money'] = UserRechargeService::create()->where(['status'=>1,'create_time'=>[[$start_time,$end_time],'between']])->sum('money')??0;
                $save['cash_out_money'] = UserCashOutService::create()->where(['status'=>1,'create_time'=>[[$start_time,$end_time],'between']])->sum('money')??0;
                $save['net_recharge_money'] = $save['recharge_money']-$save['cash_out_money'];
                $save['create_time'] = date('Y-m-d H:i:s');
                $save['update_time'] = date('Y-m-d H:i:s');
                if( DataStatisticsService::create()->getOne(['date'=>$date])){
                    DataStatisticsService::create()->update(['date'=>$date],$save);
                    $log_contents = "{$date}数据统计更新成功".PHP_EOL.json_encode($save,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'daily_data_statistics');
                }else{
                    DataStatisticsService::create()->save($save);
                    $log_contents = "{$date}数据统计写入成功".PHP_EOL.json_encode($save,JSON_UNESCAPED_UNICODE);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'daily_data_statistics');
                }

            }
        });

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        $log_contents =date('Y-m-d H:i:s').$throwable->getMessage();
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'daily_data_statistics');
    }
}