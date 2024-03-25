<?php
namespace App\Model;


class HistoryModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_history';
    protected $fields = 'id,create_time,update_time,`event_id`,`h2h`,`home`,`away`';
    // 验证规则
    protected $validate_rules = array (
  'event_id' => 'required|notEmpty',
  'h2h' => 'required|notEmpty',
  'home' => 'required|notEmpty',
  'away' => 'required|notEmpty',
);

    // 验证错误消息提示
    protected $validate_messages = array (
  'event_id' => 'event_id必须',
  'h2h' => 'h2h必须',
  'home' => 'home必须',
  'away' => 'away必须',
);

    // 验证字段的别名
    protected $validate_alias = array (
  'event_id' => 'event_id',
  'h2h' => 'h2h',
  'home' => 'home',
  'away' => 'away',
);
    protected $validate_type = array (
  'add' => 
  array (
    0 => 'event_id',
    1 => 'h2h',
    2 => 'home',
    3 => 'away',
  ),
  'edit' => 
  array (
    0 => 'event_id',
    1 => 'h2h',
    2 => 'home',
    3 => 'away',
  ),
);

}