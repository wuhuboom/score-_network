<?php
namespace App\Model;


class ProductModel extends BaseModel
{
    protected $tableName = 'td_product';
    protected $fields = 'id,vip_id,type,name,image,price,price_s,sort,stock,price,price_s,daily_yield,daily_yield_s,create_time,update_time,remark';

    // 验证规则
    protected $validate_rules = [
        'vip_id' => 'required|notEmpty',
        'type' => 'required|notEmpty',
        'name' => 'required|notEmpty',
        'image' => 'required|notEmpty',
        'price' => 'required|notEmpty',
        'daily_yield' => 'required|notEmpty',
        'sort' => 'required|notEmpty',
        'stock' => 'required|notEmpty',
        'maximum_share' => 'required|notEmpty',
        'revenue_days' => 'required|notEmpty',
        'status' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'vip_id'        => 'VIP等级必须选择',
        'type'          => '产品类型必须选择',
        'name'          => '产品名称必须填写',
        'image'         => '产品图片必须上传',
        'price'         => '产品价格必须填写',
        'daily_yield'   => '日收益率必须填写',
        'stock'         => '产品库存必须填写',
        'maximum_share' => '最大购买份额必须填写',
        'revenue_days'  => '可收益天数必须填写',
        'status'        => '产品状态必须选择',
    ];

    // 验证字段的别名
    protected $validate_alias = [
//        'vip_id'        => 'VIP等级必须选择',
        'type'          => '产品类型必须选择',
        'name'          => '产品名称必须填写',
        'image'         => '产品图片必须上传',
        'price'         => '产品价格必须填写',
        'daily_yield'   => '日收益率必须填写',
        'stock'         => '产品库存必须填写',
        'maximum_share' => '最大购买份额必须填写',
        'revenue_days'  => '可收益天数必须填写',
        'status'        => '产品状态必须选择',
    ];
    protected $validate_type = [
        'add' => ['vip_id','type','name','image','price','daily_yield','stock','maximum_share','revenue_days','status'],
        'edit' => ['vip_id','type','name','image','price','daily_yield','stock','maximum_share','revenue_days','status']
    ];

    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setPriceSAttr($value, $data)
    {
        return number_format($value,2);
    }
    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setDailyYieldSAttr($value, $data)
    {
        return (string)$value;
    }
}