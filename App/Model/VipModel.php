<?php
/**
 * Created by PhpStorm.
 * User: Double-jin
 * Date: 2022-04-23
 * Email: 283366402@qq.com
 */

namespace App\Model;


class VipModel extends BaseModel
{
    protected $tableName = 'td_vip';
    protected $fields = 'id,name,code,level,people_num,require_buy,require_buy_s,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'code' => 'required|notEmpty',
        'name' => 'required|notEmpty',
        'level' => 'required|notEmpty',
        'people_num' => 'required|notEmpty',
        'require_buy' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'code' => 'VIP级别编码必须填写',
        'name' => 'VIP级别名称必须填写',
        'level' => 'VIP级别必须填写',
        'people_num' => '该级别需要邀请人数必须填写',
        'require_buy' => '该级别需购买产品必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'code' => 'VIP级别编码必须填写',
        'name' => 'VIP级别名称必须填写',
        'level' => 'VIP级别必须填写',
        'people_num' => '该级别需要邀请人数必须填写',
        'require_buy' => '该级别需购买产品必须填写',
    ];
    protected $validate_type = [
        'add' => ['code','name','level','people_num','require_buy'],
        'edit' => ['code','name','level','people_num','require_buy'],

    ];

    /**
     * $value mixed 是原值
     * $data  array 是当前model所有的值
     */
    protected function setRequireBuySAttr($value, $data)
    {
        return number_format($value,2);
    }


}