<?php


namespace App\Model;

use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class AuthGroupModel extends BaseModel
{
    protected $tableName = 'td_auth_group';
    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',
        'rules' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name' => '权限分组名称必须',
        'auth_rule_ids' => '权限分组规则必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name' => '权限分组名称',
        'auth_rule_ids' => '权限分组规则',
    ];
    protected $validate_type = [
        'add' => ['name', 'auth_rule_ids'],
        'edit' => ['name', 'auth_rule_ids']
    ];
    //获取器
    protected function getCreateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }
    //获取器
    protected function getUpdateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    //获取器
    protected function getAuthRuleIdsAttr($value, $data)
    {
        return $value?explode(',',$value):[];
    }


}