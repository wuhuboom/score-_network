<?php
namespace App\Model;


class TeamModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_team';
    protected $fields = 'id,create_time,update_time,`name`,`cc`,`image_id`,`has_squad`';
    // 验证规则
    protected $validate_rules = array (
  'name' => 'required|notEmpty',
  'cc' => 'required|notEmpty',
  'image_id' => 'required|notEmpty',
  'has_squad' => 'required|notEmpty',
);

    // 验证错误消息提示
    protected $validate_messages = array (
  'name' => 'name必须',
  'cc' => 'cc必须',
  'image_id' => 'image_id必须',
  'has_squad' => 'has_squad必须',
);

    // 验证字段的别名
    protected $validate_alias = array (
  'name' => 'name',
  'cc' => 'cc',
  'image_id' => 'image_id',
  'has_squad' => 'has_squad',
);
    protected $validate_type = array (
  'add' => 
  array (
    0 => 'name',
    1 => 'cc',
    2 => 'image_id',
    3 => 'has_squad',
  ),
  'edit' => 
  array (
    0 => 'name',
    1 => 'cc',
    2 => 'image_id',
    3 => 'has_squad',
  ),
);

}