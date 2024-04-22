<?php
namespace App\Model;


class OrderModel extends BaseModel
{
    protected $tableName = 'td_order';
    protected $fields = 'id,user_id,product_id,order_id,status,settle_status,settle_money,settle_money_s,price_s,remark,create_time,update_time,remark';

    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'product_id' => 'required|notEmpty',
        'type' => 'required|notEmpty',
        'status' => 'required|notEmpty',
        'price' => 'required|notEmpty',
        'buy_share' => 'required|notEmpty',
        'daily_yield' => 'required|notEmpty',
        'order_money' => 'required|notEmpty',
        'daily_income' => 'required|notEmpty',
        'estimated_income' => 'required|notEmpty',
        'generated_money' => 'required|notEmpty',
        'expire_time' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id'          => '用户ID必须',
        'product_id'       => '产品ID必须',
        'revenue_days'     => '产品ID必须',
        'price'            => '产品价格必须',
        'buy_share'        => '购买份额必须',
        'order_money'      => '订单金额必须',
        'daily_yield'      => '每日收益率必须',
        'daily_income'     => '每日收益必须',
        'estimated_income' => '预估收益必须',
        'generated_money'  => '已产生收益必须',
        'expire_time'      => '到期时间必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id'          => '用户ID必须',
        'product_id'       => '产品ID必须',
        'revenue_days'     => '产品ID必须',
        'price'            => '产品价格必须',
        'buy_share'        => '购买份额必须',
        'order_money'      => '订单金额必须',
        'daily_yield'      => '每日收益率必须',
        'daily_income'     => '每日收益必须',
        'estimated_income' => '预估收益必须',
        'generated_money'  => '已产生收益必须',
        'expire_time'      => '到期时间必须',
    ];
    protected $validate_type = [
        'add' => ['user_id','product_id','order_money','daily_income','estimated_income','generated_money','expire_time'],
        'edit' => ['order_money','daily_income','estimated_income','generated_money']
    ];

    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setOrderMoneySAttr($value, $data)
    {
        return number_format($value,2);
    }

}