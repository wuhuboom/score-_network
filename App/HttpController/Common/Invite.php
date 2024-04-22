<?php

namespace App\HttpController\Common;


use App\Log\LogHandler;
use App\Service\UserService;
use EasySwoole\Mysqli\QueryBuilder;

/**
 * @todo    用户公共类
 * @version    v1.0.0
 */
class Invite
{
	/**
	 * 购买产品佣金奖励
	 * @param $product_type 产品类型
	 * @param $money 购买金额
	 * @param $user_id 购买用户ID
	 * @return false
	 */
    static public function productRewards($product_type,$money,$user_id){
	    try {
		    $log_contents = "发放佣金：{$product_type}_{$money}_{$user_id}";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
		    $config = Common::getSystem()['product_config'];
		    $balance_field =$config['commission_balance_type']==1?'balance_in':'balance_out';
		    $balance_type = $config['commission_balance_type']==1?1:2;
		    if($product_type==1){
			    $product_commission_field_name = 'yield_level_';
		    }else if($product_type==2){
			    $product_commission_field_name = 'day_level_';
		    }else{
			    $product_commission_field_name = 'activity_level_';
		    }

		    //一级佣金
		    $user = UserService::create()->get($user_id);
		    $parent = UserService::create()->get($user['parent_id']??0);
		    $ratio = $config[$product_commission_field_name.'1'];
		    $balance = $money*$ratio;
		    if($parent&&$ratio>0&&$balance){
			    $remark = '一级佣金';
			    $reward_res = User::writeUserReward($parent['id'],$balance_type,5,$balance,$remark);
			    $user_res = UserService::create()->update($parent['id'],[
				    $balance_field=>QueryBuilder::inc($balance),
				    'sum_'.$balance_field=>QueryBuilder::inc($balance),
				    'update_time'=>date('Y-m-d H:i:s'),
			    ]);
			    $balance_type = $config['commission_balance_type']==1;
			    $type = 7;
			    $before_balance = $parent[$balance_field];
			    $after_balance =  $parent[$balance_field]+$balance;

			    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($parent['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
			    if($reward_res&&$user_res&&$UserBalanceDetailsId){
				    $log_contents = "发放一级佣金成功：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }else{
				    $log_contents = "发放一级佣金失败：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}_{$reward_res}_{$user_res}_{$UserBalanceDetailsId}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }
		    }

		    //二级佣金
		    $user = UserService::create()->get($parent['id']);
		    $parent = UserService::create()->get($user['parent_id']??0);
		    $ratio = $config[$product_commission_field_name.'2'];
		    $balance = $money*$ratio;
		    if($parent&&$ratio>0&&$balance){
			    $remark = '二级佣金';
			    $reward_res = User::writeUserReward($parent['id'],$balance_type,5,$balance,$remark);
			    $user_res = UserService::create()->update($parent['id'],[
				    $balance_field=>QueryBuilder::inc($balance),
				    'sum_'.$balance_field=>QueryBuilder::inc($balance),
				    'update_time'=>date('Y-m-d H:i:s'),
			    ]);
			    $balance_type = $config['commission_balance_type']==1;
			    $type = 7;
			    $before_balance = $parent[$balance_field];
			    $after_balance =  $parent[$balance_field]+$balance;
			    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($parent['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
			    if($reward_res&&$user_res&&$UserBalanceDetailsId){
				    $log_contents = "发放二级佣金成功：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }else{
				    $log_contents = "发放二级佣金失败：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}_{$reward_res}_{$user_res}_{$UserBalanceDetailsId}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }
		    }

		    //三级佣金
		    $user = UserService::create()->get($parent['id']);
		    $parent = UserService::create()->get($user['parent_id']??0);
		    $ratio = $config[$product_commission_field_name.'3'];
		    $balance = $money*$ratio;
		    if($parent&&$ratio>0&&$balance){
			    $remark = '二级佣金';
			    $reward_res = User::writeUserReward($parent['id'],$balance_type,5,$balance,$remark);
			    $user_res = UserService::create()->update($parent['id'],[
				    $balance_field=>QueryBuilder::inc($balance),
				    'sum_'.$balance_field=>QueryBuilder::inc($balance),
				    'update_time'=>date('Y-m-d H:i:s'),
			    ]);
			    $balance_type = $config['commission_balance_type']==1;
			    $type = 7;
			    $before_balance = $parent[$balance_field];
			    $after_balance =  $parent[$balance_field]+$balance;
			    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($parent['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
			    if($reward_res&&$user_res&&$UserBalanceDetailsId){
				    $log_contents = "发放二级佣金成功：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }else{
				    $log_contents = "发放二级佣金失败：{$product_type}_{$money}_{$user_id}_{$parent['id']}_{$balance}_{$reward_res}_{$user_res}_{$UserBalanceDetailsId}";
				    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
			    }
		    }
		 
		    return true;
	    }catch (\Throwable $e){
		    $log_contents = "发放产品佣金异常：{$product_type}_{$money}_{$user_id}{$e->getMessage()}";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Invite_reward');
	    }

    }

    /**
     * 用户激活奖励
     */
    static public function activeReward($user_id){
	    try {
		    $user_info = UserService::create()->get($user_id);
		    $config = Common::getSystem()['tasks_config'];
		    if($user_info['parent_id']&&$config['task_invitation_active_enable']){
			    $user = UserService::create()->get($user_info['parent_id']);
			    $balance_field = $config['task_invitation_active_balance_type']==1?'balance_in':'balance_out';
			    $balance = $config['task_invitation_active_money']??0;
			    if($balance>0){
				    $user_res = UserService::create()->update($user['id'], [
					    $balance_field          => QueryBuilder::inc($balance),
					    'sum_' . $balance_field => QueryBuilder::inc($balance),
					    'update_time'           => date('Y-m-d H:i:s'),
				    ]);
				    $balance_type = $config['task_invitation_active_balance_type']==1?1:2;
				    $type = 6;
				    $before_balance = $user[$balance_field];
				    $after_balance = $user[$balance_field]+$balance;
				    $remark = '邀请激活奖励';
				    $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
				    $UserRewardId = \App\HttpController\Common\User::writeUserReward($user['id'],$balance_type,4,$balance,$remark);
				    if($user_res&&$UserBalanceDetailsId&&$UserRewardId){
					    $log_contents = "发放邀请激活奖励成功：{$user_id}_{$balance}";
					    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Active_reward');
				    }else{
					    $log_contents = "发放邀请激活奖励失败：{$user_id}_{$balance}";
					    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Active_reward');
				    }
				    return  true;
			    }else{
				    return  true;
			    }
		    }else{
			    return true;
		    }
	    }catch (\Throwable $e){
		    $log_contents = "发放产品佣金异常：{$user_id}_{$e->getMessage()}";
		    LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Active_reward');
	    }

    }

	/**
	 * 用户注册奖励
	 */
	static public function registerReward($user_id){
		try {
			$user_info = UserService::create()->get($user_id);
			$config = Common::getSystem()['tasks_config'];
			if($user_info['parent_id']&&$config['task_invitation_register_enable']){
				$user = UserService::create()->get($user_info['parent_id']);
				$balance_field = $config['task_invitation_register_balance_type']==1?'balance_in':'balance_out';
				$balance = $config['task_invitation_register_money']??0;
				if($balance>0){
					$user_res = UserService::create()->update($user['id'], [
						$balance_field          => QueryBuilder::inc($balance),
						'sum_' . $balance_field => QueryBuilder::inc($balance),
						'update_time'           => date('Y-m-d H:i:s'),
					]);
					$balance_type = $config['task_invitation_register_balance_type']==1?1:2;
					$type = 6;
					$before_balance = $user[$balance_field];
					$after_balance = $user[$balance_field]+$balance;
					$remark = '邀请注册奖励';
					$UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
					$UserRewardId = \App\HttpController\Common\User::writeUserReward($user['id'],$balance_type,3,$balance,$remark);
					if($user_res&&$UserBalanceDetailsId&&$UserRewardId){
						$log_contents = "发放邀请注册奖励成功：{$user_id}_{$balance}";
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Register_reward');
					}else{
						$log_contents = "发放邀请注册奖励失败：{$user_id}_{$balance}";
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Register_reward');
					}
					return  true;
				}else{
					return  true;
				}
			}else{
				return true;
			}
		}catch (\Throwable $e){
			$log_contents = "发放产品佣金异常：{$user_id}_{$e->getMessage()}";
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Register_reward');
		}

	}




}

