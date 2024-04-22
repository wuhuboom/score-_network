<?php
namespace App\Model;


use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class AuthRuleModel extends BaseModel
{
    protected $tableName = 'td_auth_rule';

    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',
        'method' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name' => '功能名称必须填写',
        'method' => '功能路由必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name' => '功能名称',
        'method' => '功能路由',
    ];
    protected $validate_type = [
        'add' => ['name', 'method'],
        'edit' => ['name', 'method']
    ];



}