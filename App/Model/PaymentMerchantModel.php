<?php
namespace App\Model;

class PaymentMerchantModel extends BaseModel
{
    protected $tableName = 'td_payment_merchant';
    protected $fields = 'id,type,name,remark,info,is_open,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'type' => 'required|notEmpty',
        'name' => 'required|notEmpty',
        'info' => 'required|notEmpty',


    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'type' => '商户号类型',
        'name' => '商户号姓名',
        'info' => '商户号信息',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'type' => '商户号类型',
        'name' => '商户号姓名',
        'info' => '商户号信息',
    ];

    protected $validate_type = [
        'add' => ['type','info' ,'name'],
        'edit' => ['type','info' ,'name'],
    ];

    //获取签到规则配置
    protected function getInfoAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }


}