<?php
/**
 * Created by PhpStorm.
 * User: tudou
 * Date: 2022-04-01
 * Email: 283366402@qq.com
 */

namespace App\Model;


class %s extends \App\Model\BaseModel
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