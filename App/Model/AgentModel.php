<?php
namespace App\Model;


class AgentModel extends BaseModel
{
    protected $tableName = 'td_agent';
    protected $fields = 'id,code,name,is_generate_account,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'code' => 'required|notEmpty',
        'name' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'code'          => '代理编码必须填写',
        'name'          => '代理名称必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'code'          => '代理编码必须填写',
        'name'          => '代理名称必须填写',
    ];
    protected $validate_type = [
        'add'  => ['code','name'],
        'edit' => ['code','name']
    ];


}