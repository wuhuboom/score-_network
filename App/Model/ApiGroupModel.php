<?php
namespace App\Model;


class ApiGroupModel extends BaseModel
{
    protected $tableName = 'td_api_group';
    protected $fields = 'id,name,sort,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name' => '名称必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name' => '名称必须',
    ];
    protected $validate_type = [
        'add' => ['name'],
        'edit' => ['name']
    ];

}