<?php
namespace App\Model;


class BankModel extends BaseModel
{
    protected $tableName = 'td_bank';
    protected $fields = 'id,bank_name,bank_code,sort,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'bank_name' => 'required|notEmpty',
        'bank_code' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'bank_name' => '银行名称',
        'bank_code' => '银行编码',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'bank_name' => '银行名称',
        'bank_code' => '银行编码',
    ];
    protected $validate_type = [
        'add' => ['bank_name','bank_code'],
        'edit' => ['bank_name','bank_code'],
    ];

}