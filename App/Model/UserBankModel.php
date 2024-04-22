<?php
namespace App\Model;


class UserBankModel extends BaseModel
{
    protected $tableName = 'td_user_bank';
    protected $fields = 'id,username,nickname,status,sort,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'bank_id' => 'required|notEmpty',
        'bank_name' => 'required|notEmpty',
        'bank_code' => 'required|notEmpty',
        'card_holder_name' => 'required|notEmpty',
        'card_number' => 'required|notEmpty',
        'status' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id'          => '所属用户必须选择',
        'bank_id'          => '所属银行必须选择',
        'bank_name'        => '银行名称必须',
        'bank_code'        => '银行编码必须',
        'card_holder_name' => '持卡人必须填写',
        'card_number'      => '卡号必须填写',
        'status'           => '银行卡状态必须选择',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id'          => '所属用户必须选择',
        'bank_id'          => '所属银行必须选择',
        'bank_name'        => '银行名称必须',
        'bank_code'        => '银行编码必须',
        'card_holder_name' => '持卡人必须填写',
        'card_number'      => '卡号必须填写',
        'status'           => '银行卡状态必须选择',
    ];
    protected $validate_type = [
        'add' => ['user_id','bank_id','bank_name','bank_code','card_holder_name','card_number'],
        'edit' => ['user_id','bank_id','bank_name','bank_code','card_holder_name','card_number'],
    ];

}