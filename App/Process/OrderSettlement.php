<?php


namespace App\Process;


use App\HttpController\Common\Activity;
use App\HttpController\Common\Common;
use App\HttpController\Common\Distribution;
use App\Log\LogHandler;
use App\Model\DistributionIncomeModel;
use App\Model\OrderModel;
use App\Model\OrderRefundModel;
use App\Model\ResellerBalanceDetailsModel;
use App\Model\ResellerModel;
use App\Model\UserBalanceDetailsModel;
use App\Model\UserModel;
use App\Service\OrderService;
use App\Service\OrderSettlementService;
use App\Service\UserService;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;


class OrderSettlement extends AbstractProcess
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
                    $where['settle_status'] = [0,'='];
                    $where['execute_time'] = [date('Y-m-d H:i:s',time()),'<'] ;
                    $order_settlement = OrderSettlementService::create()->getOne($where);

                    if(!empty($order_settlement)){
	                    $generated_income = OrderSettlementService::create()->where(['order_id'=>$order_settlement['order_id'],'settle_status'=>1])->sum('settle_money')??0;
                        $user = UserService::create()->get($order_settlement['user_id']);
                        $system  = Common::getSystem();
                        $balance_field = $system['product_config']['settlement_balance_type']==1?'balance_in':'balance_out';

                        $orderSettlementResult = OrderSettlementService::create()->update($order_settlement['id'], [
                            'settle_status' => 1,
                            'settle_time'   => date('Y-m-d H:i:s')
                        ]);

                        //更新用户余额
                        $userResult = UserService::create()->update($user['id'], [
                            $balance_field => QueryBuilder::inc($order_settlement['settle_money']),
                            'update_time'  => date('Y-m-d H:i:s'),
                        ]);
                        //更新订单信息
	                    $orderResult = OrderService::create()->update($order_settlement['order_id'], ['generated_income' => $generated_income + $order_settlement['settle_money'], 'update_time' => date('Y-m-d H:i:s')]);
                        $balance_type = $system['customer_config']['settlement_balance_type']==1?1:2;
                        $type = 5;
                        $balance = $order_settlement['settle_money'];
                        $before_balance = $user[$balance_field];
                        $after_balance = $user[$balance_field]+$balance;
                        $remark = '产品订单结算';
                        $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
                        if($orderSettlementResult&&$userResult&&$orderResult&&$UserBalanceDetailsId){
                            DbManager::getInstance()->commit();
                            $log_contents = "结算订单成功：{$order_settlement['date']}_{$order_settlement['id']}_{$order_settlement['user_id']}_{$order_settlement['settle_money']}";
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_settlement');
                        }else{
                            DbManager::getInstance()->rollback();
                            $log_contents = "结算订单失败：{$order_settlement['date']}_{$order_settlement['id']}_{$order_settlement['settle_money']}_{$orderSettlementResult}_{$userResult}_{$UserBalanceDetailsId}";
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_settlement');
                        }

                    }else{
	                    $log_contents = "没有需要结算的订单";
	                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_settlement');
                        \co::sleep(1);
                        continue;
                    }

                }catch (\Throwable $e){
                    DbManager::getInstance()->rollback();
                    $log_contents = "结算订单失败：{$e->getMessage()}_{$e->getLine()}_{$e->getCode()}";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'order_settlement');
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