<?php
namespace App\Model;


class TasksModel extends BaseModel
{
    protected $tableName = 'td_tasks';
    protected $fields = 'id,name,active_number,amount,amount_s,status,create_time,update_time';

    // 验证规则
    protected $validate_rules = [

        'name' => 'required|notEmpty',
        'active_number' => 'required|notEmpty',
        'amount' => 'required|notEmpty',
        'status' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name'          => '产品名称必须填写',
        'amount'        => '奖励金额必须填写',
        'active_number' => '激活人数必须填写',
        'status'        => '任务状态必须选择',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name'          => '产品名称必须填写',
        'amount'        => '奖励金额必须填写',
        'active_number' => '激活人数必须填写',
        'status'        => '任务状态必须选择',
    ];
    protected $validate_type = [
        'add' => ['name','amount','active_number','status'],
        'edit' => ['name','amount','active_number','status']
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