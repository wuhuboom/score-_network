<?php
namespace App\Model;


class %sModel extends \App\Model\BaseModel
{
    protected $tableName = '%s';
    protected $fields = '%s';
    // 验证规则
    protected $validate_rules = %s;

    // 验证错误消息提示
    protected $validate_messages = %s;

    // 验证字段的别名
    protected $validate_alias = %s;
    protected $validate_type = %s;

}