<?php
namespace App\Crontab;

use App\Log\LogHandler;
use App\Model\OrderSettlementModel;
use App\Service\OrderService;
use App\Service\OrderSettlementService;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class GenerateOrderSettlement extends AbstractCronTask
{
    //自动生成每日收益产品结算订单
    public static function getRule(): string
    {
        return '*/1 * * * *';
        //return '0 0 * * *';
    }

    public static function getTaskName(): string
    {
        return  'GenerateOrderSettlement';
    }

    function run(int $taskId, int $workerIndex)
    {

        //订单自动过期，
        go(function (){
            $date = date('Y-m-d');
            $datetime = date('Y-m-d 00:00:00');
            $log_contents = '自动生成每日收益产品结算订单开始';
            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
            //每日收益产品结算
            $where['product_type'] = [2,'='];
            $where['status'] = [1,'='];
            $where['is_del'] = [0,'='];
            $where['expire_time'] = [$datetime,'>'];
            $where['create_time'] = [$datetime,'<'];
            $list  = OrderService::create()->getLists($where);
            if($list['list']){
                foreach ($list['list'] as $k=>$v){
                    $order_settlement_data = [
                        'date'           => date('Y-m-d'),
                        'user_id'        => $v['user_id'],
                        'product_id'     => $v['product_id'],
                        'order_id'       => $v['id'],
                        'status'         => 1,
                        'settle_status'  => 0,
                        'settle_money'   => $v['price']*$v['daily_yield'],
                        'settle_money_s' => $v['price']*$v['daily_yield'],
                        'remark'         => '',
                        'create_time'    => date('Y-m-d H:i:s'),
                        'update_time'    => date('Y-m-d H:i:s')
                    ];
                    if(!OrderSettlementService::create()->getOne(['order_id'=>[$v['id'],'='],'date'=>[$date,'=']])){

                        if($insert_id = OrderSettlementService::create()->save($order_settlement_data)){
                            $log_contents = $datetime.'每日收益产品结算订单生成成功：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                        }else{
                            $log_contents = $datetime.'每日收益产品结算订单生成失败：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                        }

                    }else{
                        $log_contents = "结算订单已存在：{$v['id']}_{$date}";
                        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
                    }
                }
            }
	        $log_contents = '自动生成每日收益产品结算订单结束';
	        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');

	        $date = date('Y-m-d');
	        $start_time = date('Y-m-d 00:00:00');
	        $end_time = date('Y-m-d 23:59:59');
	        $log_contents = '自动生成结算订单开始';
	        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
	        //每日收益产品结算
	        $where['product_type'] = [2,'<>'];
	        $where['status'] = [1,'='];
	        $where['is_del'] = [0,'='];
	        $where['expire_time'] = [[$start_time,$end_time],'between'];
	        $where['create_time'] = [$datetime,'<'];
	        $list  = OrderService::create()->getLists($where);
	        if($list['list']){
		        foreach ($list['list'] as $k=>$v){
			        $order_settlement_data = [
				        'date'           => date('Y-m-d'),
				        'user_id'        => $v['user_id'],
				        'product_id'     => $v['product_id'],
				        'order_id'       => $v['id'],
				        'status'         => 1,
				        'settle_status'  => 0,
				        'settle_money'   => $v['buy_share']*$v['price']*$v['daily_yield'],
				        'settle_money_s' => $v['price']*$v['daily_yield'],
				        'remark'         => '',
				        'create_time'    => date('Y-m-d H:i:s'),
				        'update_time'    => date('Y-m-d H:i:s')
			        ];
			        if(!OrderSettlementService::create()->getOne(['order_id'=>[$v['id'],'='],'date'=>[$date,'=']])){

				        if($insert_id = OrderSettlementService::create()->save($order_settlement_data)){
					        $log_contents = $datetime.'长期收益型产品结算订单生成成功：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
					        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
				        }else{
					        $log_contents = $datetime.'长期收益型产品结算订单生成失败：'.json_encode($order_settlement_data,JSON_UNESCAPED_UNICODE);
					        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
				        }

			        }else{
				        $log_contents = "结算订单已存在：{$v['id']}_{$date}";
				        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
			        }
		        }
	        }
	        $log_contents = '自动生成长期收益型结算订单结束';
	        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');

        });

    }

    function onException(\Throwable $throwable, int $taskId, int $workerIndex)
    {
        $log_contents = '订单自动过期异常'.$throwable->getMessage();
        LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'generate_order_settlement');
    }
}