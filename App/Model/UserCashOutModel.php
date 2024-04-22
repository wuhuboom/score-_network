<?php
namespace App\Model;


class UserCashOutModel extends BaseModel
{
    protected $tableName = 'td_user_cash_out';
    protected $fields = 'id,user_id,order_no,payway_id,user_bank_id,money,received_amount,tax_money,status,cost_time,finish_time,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'user_id'         => 'required|notEmpty',
        'payway_id'       => 'required|notEmpty',
        'money'           => 'required|notEmpty',
        'received_amount' => 'required|notEmpty',
        'tax_money'       => 'required|notEmpty',
        'status'          => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id'         => '所属用户必须选择',
        'payway_id'       => '支付通道必须选择',
        'money'           => '充值金额必须',
        'received_amount' => '到账金额必须',
        'tax_money'       => '手续费必须',
        'status'          => '充值状态必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id'         => '所属用户必须选择',
        'payway_id'       => '支付通道必须选择',
        'money'           => '充值金额必须',
        'received_amount' => '到账金额必须',
        'tax_money'       => '手续费必须',
        'status'          => '充值状态必须',
    ];
    protected $validate_type = [
        'add' => ['user_id','payway_id','money','received_amount','tax_money','status'],
        'edit' => ['user_id','payway_id','money','received_amount','tax_money','status'],
    ];

}