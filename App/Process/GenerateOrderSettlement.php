<?php


namespace App\Process;

use App\Log\LogHandler;
use App\Service\OrderService;
use App\Service\OrderSettlementService;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\ORM\DbManager;


class GenerateOrderSettlement extends AbstractProcess
{

    protected function run($arg)
    {
        $pid = $this->getPid();
        // TODO: Implement run() method.
        go(function ()use ($pid){
            while (1){
                \co::sleep(1);
                try {
                    DbManager::getInstance()->startTransaction();
                    $where['status'] = [1,'='];
                    $where['is_del'] = [0,'='];
                    $where['is_generated_order_settlement'] = [0,'='];

                    $order = OrderService::create()->getOne($where);
                    //$order = OrderService::create()->get(29);

                    if(!empty($order)) {
                        $update_order = OrderService::create()->update(['id'=>$order['id']],['is_generated_order_settlement'=>1,'update_time'=>date('Y-m-d H:i:s')]);

	                    if($update_order){
                            if($order['product_type']==2){//每日收益产品生成订单
	                            $log_contents = '天数：'.$order['revenue_days'];
	                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                for($i=1;$i<=$order['revenue_days'];$i++){
                                    $order_settlement_data = [
                                        'date'           => date('Y-m-d',strtotime($order['create_time'])+$i*24*3600),
                                        'execute_time'   => date('Y-m-d H:i:s',strtotime($order['create_time'])+$i*24*3600),
                                        'user_id'        => $order['user_id'],
                                        'product_id'     => $order['product_id'],
                                        'order_id'       => $order['id'],
                                        'status'         => 1,
                                        'settle_status'  => 0,
                                        'settle_money'   => $order['buy_share']*$order['price'] * $order['daily_yield'],
                                        'settle_money_s' => $order['buy_share']*$order['price'] * $order['daily_yield'],
                                        'remark'         => '',
                                        'create_time'    => date('Y-m-d H:i:s'),
                                        'update_time'    => date('Y-m-d H:i:s')
                                    ];
                                    if(!OrderSettlementService::create()->getOne(['order_id'=>[$order['id'],'='],'date'=>[$order_settlement_data['date'],'=']])){
                                        if($insert_id = OrderSettlementService::create()->save($order_settlement_data)){
                                            $log_contents = '每日收益产品结算订单生成成功：'.$order['days'].json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                        }else{
                                            $log_contents = '每日收益产品结算订单生成失败：'.$order['days'].json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                        }

                                    }else{
                                        $log_contents = "每日收益结算订单已存在：{$order['id']}_{$order_settlement_data['date']}";
                                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                    }
                                }
	                            DbManager::getInstance()->commit();
                            }else{
                                $order_settlement_data = [
                                    'date'           => date('Y-m-d',strtotime($order['create_time'])+$order['revenue_days']*24*3600),
                                    'execute_time'   => date('Y-m-d H:i:s',strtotime($order['create_time'])+$order['revenue_days']*24*3600),
                                    'user_id'        => $order['user_id'],
                                    'product_id'     => $order['product_id'],
                                    'order_id'       => $order['id'],
                                    'status'         => 1,
                                    'settle_status'  => 0,
                                    'settle_money'   => $order['buy_share']*$order['price'] * $order['daily_yield']*$order['days'],
                                    'settle_money_s' => $order['buy_share']*$order['price'] * $order['daily_yield']*$order['days'],
                                    'remark'         => '',
                                    'create_time'    => date('Y-m-d H:i:s'),
                                    'update_time'    => date('Y-m-d H:i:s')
                                ];
                                if(!OrderSettlementService::create()->getOne(['order_id'=>[$order['id'],'='],'date'=>[$order_settlement_data['date'],'=']])){

                                    if($insert_id = OrderSettlementService::create()->save($order_settlement_data)){
	                                    DbManager::getInstance()->commit();
                                        $log_contents = '长期/活动收益产品结算订单生成成功：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                    }else{
	                                    DbManager::getInstance()->rollback();
                                        $log_contents = '长期/活动产品结算订单生成失败：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                    }

                                }else{
	                                DbManager::getInstance()->commit();
                                    $log_contents = "长期/活动结算订单已存在：{$order['id']}_{$order_settlement_data['date']}";
                                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                                }
                            }

                        }else{
                            DbManager::getInstance()->rollback();
                            $log_contents = "更新订单失败";
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                        }
                    }else{
	                    DbManager::getInstance()->rollback();
//	                    $log_contents = "没有可生成结算订单的产品";
//	                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                    }

                }catch (\Throwable $e){
                    DbManager::getInstance()->rollback();
                    $log_contents = "生成结算订单失败：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                    if (strrpos(strtoupper($e->getMessage()),'SQLSTATE') !== false){
                        $log_contents = date('Y-m-d H:i:s').'：'."数据库连接异常：{$e->getMessage()}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'SQLSTATE');
                        \co::sleep(1);
                        $path = EASYSWOOLE_ROOT;
                        $cmd = "cd {$path};php easyswoole process kill --pid={$pid} -f";
                        $log_contents = date('Y-m-d H:i:s').'：'."自定义进程重启：{$cmd}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'SQLSTATE');
                        shell_exec($cmd);
                    }

                }


            }

        });
    }
}