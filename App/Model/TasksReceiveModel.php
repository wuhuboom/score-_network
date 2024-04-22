<?php
namespace App\Model;


class TasksReceiveModel extends BaseModel
{
    protected $tableName = 'td_tasks_receive';
    protected $fields = 'id,tasks_id,user_id,receive_amount,receive_amount_s,status,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'tasks_id' => 'required|notEmpty',
        'user_id' => 'required|notEmpty',
        'receive_amount' => 'required|notEmpty',
        'status' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'tasks_id' => '任务ID必须填写',
        'user_id'  => '用户ID必须必须填写',
        'receive_amount'   => '奖励金额必须填写',
        'status'   => '任务状态必须选择',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'tasks_id' => '任务ID必须填写',
        'user_id'  => '用户ID必须必须填写',
        'receive_amount'   => '奖励金额必须填写',
        'status'   => '任务状态必须选择',
    ];
    protected $validate_type = [
        'add' => ['tasks_id','receive_amount','user_id','status'],
        'edit' => ['tasks_id','receive_amount','user_id','status']
    ];


    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setAmountSAttr($value, $data)
    {
        return (string)$value;
    }
}