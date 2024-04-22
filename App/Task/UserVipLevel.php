<?php

namespace App\Task;

use App\Log\LogHandler;
use App\Service\OrderService;
use App\Service\TasksReceiveService;
use App\Service\TasksService;
use App\Service\UserService;
use App\Service\VipService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\Task\AbstractInterface\TaskInterface;

class UserVipLevel implements TaskInterface
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
	        \co::sleep(3);
            $user_id = $data['user_id'];
            $user = UserService::create()->get($user_id);
            if($user_id&&$user){
                $user_vip = VipService::create()->get($user['vip_id']);
                $user_level = $user_vip['level']??0;
                $buy_money = OrderService::create()->where(['user_id'=>$user_id,'is_pay'=>1,'is_del'=>0])->sum('order_money')??0;
                $active_num = UserService::create()->where(['parent_id'=>$user_id,'is_active'=>1])->count()??0;
                $vip = VipService::create()->where(['people_num'=>[$active_num,'<='],'require_buy'=>[$buy_money,'<=']])->order('level','desc')->find();
                if($vip['level']>=$user_level){
                    UserService::create()->update($user_id,['vip_id'=>$vip['id'],'update_time'=>date('Y-m-d H:i:s')]);
                    $log_contents = "用户【{$user['id']}_{$user['username']}】购买金额：{$buy_money} VIP等级从{$user_level}升至{$vip['level']}成功";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'user_vip_level');
                }else{
                    $log_contents = "用户【{$user['id']}_{$user['username']}】购买金额：{$buy_money} VIP等级从{$user_level}升至{$vip['level']}失败";
                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'user_vip_level');
                }

                //自动完成任务奖励
                $list = TasksService::create()->getLists(['active_number'=>[$active_num,'<=']])['list']??'';
	            $log_contents = "当前可完成任务：{$active_num}_".json_encode($list,JSON_UNESCAPED_UNICODE);
	            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'user_vip_level');
                foreach ($list as $k=>$v){
                    $tasks_receive = TasksReceiveService::create()->where(['tasks_id'=>$v['id'],'user_id'=>$user_id])->get();
                    if(empty($tasks_receive)){
	                    $log_contents = "完成任务活动奖励：{$v['amount']}";
	                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'user_vip_level');
                        $tasks_receive_data = [
                            'tasks_id' => $v['id'],
                            'user_id'  => $user_id,
                            'active_number'  => $v['active_number'],
                            'receive_amount'  =>$v['amount'],
                            'create_time'  =>date('Y-m-d H:i:s'),
                            'update_time'  =>date('Y-m-d H:i:s'),
                        ];
                        TasksReceiveService::create()->save($tasks_receive_data);

                        $balance_field = 'balance_in';
                        $balance = $v['amount']??0;
                        if($balance>0){
                            $user_res = UserService::create()->update($user['id'], [
                                $balance_field          => QueryBuilder::inc($balance),
                                'sum_' . $balance_field => QueryBuilder::inc($balance),
                                'update_time'           => date('Y-m-d H:i:s'),
                            ]);
                            $balance_type = 1;
                            $type = 6;
                            $before_balance = $user[$balance_field];
                            $after_balance = $user[$balance_field]+$balance;
                            $remark = '任务奖励';
                            $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
                            $UserRewardId = \App\HttpController\Common\User::writeUserReward($user['id'],$balance_type,7,$balance,$remark);
                            if($user_res&&$UserBalanceDetailsId&&$UserRewardId){
                                $log_contents = "发放任务奖励成功：{$user_id}_{$balance}";
                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Tasks_reward');
                            }else{
                                $log_contents = "发放任务奖励失败：{$user_id}_{$balance}";
                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Tasks_reward');
                            }
                        }
                    }else{
	                    $log_contents = "任务已完成";
	                    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'user_vip_level');
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