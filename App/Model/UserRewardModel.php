<?php
namespace App\Model;


class UserRewardModel extends BaseModel
{
    protected $tableName = 'td_user_reward';
    protected $fields = 'id,user_id,balance_type,reward_type,amount,status,finish_time,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'user_id'         => 'required|notEmpty',
        'balance_type'       => 'required|notEmpty',
        'reward_type'           => 'required|notEmpty',
        'amount' => 'required|notEmpty',
        'status'          => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
	    'user_id'      => '所属用户必须选择',
	    'balance_type' => '入账方式必须',
	    'reward_type'  => '奖励类型必须',
	    'amount'       => '奖励金额必须',
	    'status'       => '入账状态必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
	    'user_id'      => '所属用户必须选择',
	    'balance_type' => '入账方式必须',
	    'reward_type'  => '奖励类型必须',
	    'amount'       => '奖励金额必须',
	    'status'       => '入账状态必须',
    ];
    protected $validate_type = [
        'add' => ['user_id','balance_type','reward_type','amount','status'],
        'edit' => ['user_id','balance_type','reward_type','amount','status'],
    ];

}