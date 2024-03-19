<?php
namespace App\Model;


class TeamMembersModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_team_members';
    protected $fields = 'id,create_time,update_time,`name`,`image_id`,`cc`';
    // 验证规则
    protected $validate_rules = array (
  'name' => 'required|notEmpty',
  'image_id' => 'required|notEmpty',
  'cc' => 'required|notEmpty',
);

    // 验证错误消息提示
    protected $validate_messages = array (
  'name' => 'name必须',
  'image_id' => 'image_id必须',
  'cc' => 'cc必须',
);

    // 验证字段的别名
    protected $validate_alias = array (
  'name' => 'name',
  'image_id' => 'image_id',
  'cc' => 'cc',
);
    protected $validate_type = array (
  'add' => 
  array (
    0 => 'name',
    1 => 'image_id',
    2 => 'cc',
  ),
  'edit' => 
  array (
    0 => 'name',
    1 => 'image_id',
    2 => 'cc',
  ),
);

}