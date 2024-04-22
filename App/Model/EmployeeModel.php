<?php
namespace App\Model;


class EmployeeModel extends BaseModel
{
    protected $tableName = 'td_employee';
    protected $fields = 'id,agent_id,code,name,invitation_code,is_generate_account,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'code' => 'required|notEmpty',
        'name' => 'required|notEmpty',
        'agent_id' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'agent_id'        => '所属代理必须选择',
        'code'            => '员工编码必须填写',
        'name'            => '员工名称必须填写',
        'invitation_code' => '员工邀请码必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'agent_id'        => '所属代理必须选择',
        'code'            => '员工编码必须填写',
        'name'            => '员工名称必须填写',
        'invitation_code' => '员工邀请码必须填写',
    ];
    protected $validate_type = [
        'add'  => ['code','name','agent_id','invitation_code'],
        'edit' => ['code','name','agent_id','invitation_code']
    ];


}