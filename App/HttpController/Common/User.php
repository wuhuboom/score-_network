<?php

namespace App\HttpController\Common;



use App\Log\LogHandler;
use App\Model\BalanceDetailsModel;
use App\Model\ResellerModel;
use App\Model\UserBalanceDetailsModel;
use App\Model\UserMemberModel;
use App\Service\UserRewardService;
use App\Service\UserService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * @todo    用户公共类
 * @version    v1.0.0
 */
class User
{
    //用户余额明细

    static public function writeUserBalanceDetails($user_id,$balance_type,$type,$balance,$before_balance,$after_balance,$remark=''){
        switch ($type){
            case 1:$data['title'] = '充值';break;
            case 2:$data['title'] = '提现';break;
            case 3:$data['title'] = '提现退回';break;
            case 4:$data['title'] = '购买产品';break;
            case 5:$data['title'] = '产品佣金';break;
            case 6:$data['title'] = '任务奖励';break;
            case 7:$data['title'] = '推广佣金';break;
            case 8:$data['title'] = '系统奖励';break;
            case 9:$data['title'] = '系统扣除';break;
        }
        $balance_type = $balance_type==1?1:2;
        $data['user_id'] = $user_id;
        $data['balance'] = $balance;
        $data['before_balance'] = $before_balance;
        $data['after_balance'] = $after_balance;
        $data['balance_type'] = $balance_type;
        $data['type'] = $type;
        $data['remark'] = $remark??$data['title'];
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        if($id = UserBalanceDetailsModel::create()->data($data)->save()){
            return  $id;
        }else{
            return  false;
        }
    }
	//用户余额明细

	static public function writeUserReward($user_id,$balance_type,$reward_type,$balance,$remark=''){
		switch ($reward_type){
			case 1:$data['title'] = '发帖奖励';break;
			case 2:$data['title'] = '评论奖励';break;
			case 3:$data['title'] = '注册奖励';break;
			case 4:$data['title'] = '激活奖励';break;
			case 5:$data['title'] = '产品佣金';break;
			case 6:$data['title'] = '产品收入';break;
			case 7:$data['title'] = '任务奖励';break;
		}

		$data['user_id'] = $user_id;
		$data['balance'] = $balance;
		$data['balance_type'] = $balance_type;
		$data['reward_type'] = $reward_type;
		$data['remark'] = $remark??$data['title'];
		$data['create_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($id = UserRewardService::create()->save($data)){
			return  $id;
		}else{
			return  false;
		}
	}

	//注册赠送金额
	static public function registerGive($user_id){
		try {
			$user = UserService::create()->get($user_id);
			$config = Common::getSystem()['tasks_config'];
			if ($user && $config['task_register_give_enable']) {
				$balance_field = $config['task_register_give_balance_type'] == 1 ? 'balance_in' : 'balance_out';
				$balance = $config['task_register_give_money'] ?? 0;
				if ($balance > 0) {
					$user_res = UserService::create()->update($user['id'], [
						$balance_field          => QueryBuilder::inc($balance),
						'sum_' . $balance_field => QueryBuilder::inc($balance),
						'update_time'           => date('Y-m-d H:i:s'),
					]);
					$balance_type = $config['task_register_give_balance_type'] == 1 ? 1 : 2;
					$type = 6;
					$before_balance = $user[$balance_field];
					$after_balance = $user[$balance_field] + $balance;
					$remark = '注册奖励';
					$UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($user['id'], $balance_type, $type, $balance, $before_balance, $after_balance, $remark);
					$UserRewardId = \App\HttpController\Common\User::writeUserReward($user['id'], $balance_type, 3, $balance, $remark);
					if ($user_res && $UserBalanceDetailsId && $UserRewardId) {
						$log_contents = "发放注册奖励成功：{$user_id}_{$balance}";
						LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Register_give');
					} else {
						$log_contents = "发放注册奖励失败：{$user_id}_{$balance}";
						LogHandler::getInstance()->log($log_contents, LogHandler::getInstance()::LOG_LEVEL_INFO, 'Register_give');
					}
					return true;
				} else {
					return true;
				}
			} else {
				return true;
			}
		}catch (\Throwable $e){
			$log_contents = "发放产品佣金异常：{$user_id}_{$e->getMessage()}";
			LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'Register_give');
		}
	}


}

