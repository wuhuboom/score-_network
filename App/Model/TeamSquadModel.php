<?php
namespace App\Model;


class TeamSquadModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_team_squad';
    protected $fields = 'id,create_time,update_time,`name`,`cc`,`birthdate`,`position`,`height`,`weight`,`foot`,`shirtnumber`';
    // 验证规则
    protected $validate_rules = array (
  'name' => 'required|notEmpty',
  'cc' => 'required|notEmpty',
  'birthdate' => 'required|notEmpty',
  'position' => 'required|notEmpty',
  'height' => 'required|notEmpty',
  'weight' => 'required|notEmpty',
  'foot' => 'required|notEmpty',
  'shirtnumber' => 'required|notEmpty',
);

    // 验证错误消息提示
    protected $validate_messages = array (
  'name' => 'name必须',
  'cc' => 'cc必须',
  'birthdate' => 'birthdate必须',
  'position' => 'position必须',
  'height' => 'height必须',
  'weight' => 'weight必须',
  'foot' => 'foot必须',
  'shirtnumber' => 'shirtnumber必须',
);

    // 验证字段的别名
    protected $validate_alias = array (
  'name' => 'name',
  'cc' => 'cc',
  'birthdate' => 'birthdate',
  'position' => 'position',
  'height' => 'height',
  'weight' => 'weight',
  'foot' => 'foot',
  'shirtnumber' => 'shirtnumber',
);
    protected $validate_type = array (
  'add' => 
  array (
    0 => 'name',
    1 => 'cc',
    2 => 'birthdate',
    3 => 'position',
    4 => 'height',
    5 => 'weight',
    6 => 'foot',
    7 => 'shirtnumber',
  ),
  'edit' => 
  array (
    0 => 'name',
    1 => 'cc',
    2 => 'birthdate',
    3 => 'position',
    4 => 'height',
    5 => 'weight',
    6 => 'foot',
    7 => 'shirtnumber',
  ),
);

}