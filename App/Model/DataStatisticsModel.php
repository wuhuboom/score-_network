<?php
namespace App\Model;


class DataStatisticsModel extends BaseModel
{
    protected $tableName = 'td_data_statistics';
    protected $fields = 'id,date,register_num,active_num,recharge_money,cash_out_money,net_recharge_money,active_ratio,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'date' => 'required|notEmpty',
        'register_num' => 'required|notEmpty',
        'active_num' => 'required|notEmpty',
        'active_ratio' => 'required|notEmpty',
        'recharge_money' => 'required|notEmpty',
        'cash_out_money' => 'required|notEmpty',
        'net_recharge_money' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'date'               => '日期',
        'register_num'       => '注册用户数',
        'active_num'         => '激活用户数',
        'active_ratio'       => '激活比例',
        'recharge_money'     => '总充值金额',
        'cash_out_money'     => '总提现金额',
        'net_recharge_money' => '净充值金额',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'date'               => '日期',
        'register_num'       => '注册用户数',
        'active_num'         => '激活用户数',
        'active_ratio'       => '激活比例',
        'recharge_money'     => '总充值金额',
        'cash_out_money'     => '总提现金额',
        'net_recharge_money' => '净充值金额',
    ];
    protected $validate_type = [
        'add' => ['date','register_num','active_num','active_ratio','recharge_money','cash_out_money','net_recharge_money'],
        'edit' => ['date','register_num','active_num','active_ratio','recharge_money','cash_out_money','net_recharge_money'],
    ];

}