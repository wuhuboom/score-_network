<?php

namespace App\Crontab;

use App\Log\LogHandler;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;
use EasySwoole\ORM\DbManager;

class GenerateOrderSettlement extends AbstractCronTask
{
    //每日凌晨0点 恢复活动名额
    public static function getRule(): string
    {
        return '01 0 * * *';
    }

    public static function getTaskName(): string
    {
        return  'GenerateOrderSettlement';
    }

    function run(int $taskId, int $workerIndex)
    {
        //自动生成结算订单，
        go(function (){
            $date = date('Y-m-d',time()-24*3600);
            $log_contents = date('Y-m-d H:i:s').'：开始生成商家每日账单_'.$date;
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');

            $start_time = $date.' 00:00:00';
            $end_time = $date.' 23:59:59';
            $order_ids              = OrderModel::create()
                                                ->where('is_cancel', 0)
                                                ->where('is_abnormal', 0)
                                                ->where('is_del', 0)
                                                ->where('order_settlement_id', 0)
                                                ->where('status', 4)
                                                ->where('create_time',$start_time,'>=')
                                                ->where('create_time',$end_time,'<=')
                                                ->select();
            $shop_order = [];
            foreach ($order_ids as $v){
                $shop_order[$v['shop_id']][] = $v;
            }
            foreach ($shop_order as $k=>$order_list){
                $pay_amount =array_sum(array_column($order_list,'shop_pay_amount')) ; //应付金额
                $rake_back_amount =array_sum(array_column($order_list,'rake_back_amount')) ; //补贴金额
                $commission_amount =array_sum(array_column($order_list,'commission_amount')) ; //佣金
                $order_num = count($order_list);
                $ids = array_column($order_list,'id');
                try {
                    DbManager::getInstance()->startTransaction();
                    $data = [];
                    $data['date'] = $date;
                    $data['order_no'] = date('YmdHis').rand(10000,99999);
                    $data['shop_id'] = $order_list[0]['shop_id'];
                    $data['reseller_id'] = $order_list[0]['reseller_id'];
                    $data['is_pay'] = 0;
                    $data['pay_type'] = 'alipay';
//                $data['pay_time'] = date('Y-m-d H:i:s');
                    $data['pay_amount'] = $pay_amount;
                    $data['rake_back_amount'] = $rake_back_amount;
                    $data['commission_amount'] = $commission_amount;
                    $data['order_num'] = $order_num;
                    $data['create_time'] = date('Y-m-d H:i:s');
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $order_settlement_id = OrderSettlementModel::create()->data($data)->save();
                    $log_contents =date('Y-m-d H:i:s').'：账单生成成功,ID:'.$order_settlement_id;
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');
                    if($order_settlement_id){
                        $save_order  = [
                            'order_settlement_id'=>$order_settlement_id,
                            'update_time'=> date('Y-m-d H:i:s')
                        ];
                        $OrderModel = OrderModel::create();
                        $res = $OrderModel->where('id',$ids??[0],'in')->update($save_order);
                        if($OrderModel->lastQueryResult()->getAffectedRows()){
                            DbManager::getInstance()->commit();
                            $log_contents =date('Y-m-d H:i:s').'：订单结算成功,店铺ID:'.$data['shop_id'].',订单ID：'.implode(',',$ids);
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');

                        }else{
                            DbManager::getInstance()->rollback();
                            $log_contents =date('Y-m-d H:i:s').'：订单结算失败,店铺ID:'.$data['shop_id'].',订单ID：'.implode(',',$ids);
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');
                        }


                    }else{
                        DbManager::getInstance()->rollback();
                        $log_contents =date('Y-m-d H:i:s').'：生成账单失败,店铺ID:'.$data['shop_id'].',订单ID：'.implode(',',$ids);
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');
                    }
                }catch (\Throwable $e){
                    DbManager::getInstance()->rollback();
                    $log_contents =date('Y-m-d H:i:s').'：生成账单失败,出现错误:'.$e->getMessage().json_encode($e->getTrace(),JSON_UNESCAPED_UNICODE).implode(',',$ids);
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');
                }

            }

            $log_contents =date('Y-m-d H:i:s').'：结束生成商家每日账单_'.$date;
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'create_shop_day_bill');
        });


    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        echo $throwable->getMessage();
    }
}