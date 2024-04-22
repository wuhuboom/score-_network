<?php
namespace App\Model;


class OrderSettlementModel extends BaseModel
{
    protected $tableName = 'td_order_settlement';
    protected $fields = 'id,user_id,product_id,order_id,status,settle_status,settle_money,settle_money_s,price_s,remark,create_time,update_time,remark';

    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'product_id' => 'required|notEmpty',
        'order_id' => 'required|notEmpty',
        'settle_status' => 'required|notEmpty',
        'price' => 'required|notEmpty',
        'settle_money' => 'required|notEmpty',
        'remark' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id'       => '用户ID必须',
        'product_id'    => '产品ID必须',
        'order_id'      => '订单ID必须',
        'settle_status' => '结算状态必须',
        'settle_money'  => '结算金额必须',
        'remark'        => '备注信息必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id'       => '用户ID必须',
        'product_id'    => '产品ID必须',
        'order_id'      => '订单ID必须',
        'settle_status' => '结算状态必须',
        'settle_money'  => '结算金额必须',
        'remark'        => '备注信息必须',
    ];
    protected $validate_type = [
        'add' => ['user_id','product_id','order_id','settle_status','settle_money'],
        'edit' => ['user_id','product_id','order_id','settle_status','settle_money']
    ];

    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setSettleMoneySAttr($value, $data)
    {
        return number_format($value,2);
    }

}