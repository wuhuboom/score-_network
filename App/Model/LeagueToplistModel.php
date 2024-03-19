<?php
namespace App\Model;


class LeagueToplistModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_league_toplist';
    protected $fields = 'id,create_time,update_time,`topgoals`,`topassists`,`topcards`,`injuries`';
    // 验证规则
    protected $validate_rules = array (
  'topgoals' => 'required|notEmpty',
  'topassists' => 'required|notEmpty',
  'topcards' => 'required|notEmpty',
  'injuries' => 'required|notEmpty',
);

    // 验证错误消息提示
    protected $validate_messages = array (
  'topgoals' => 'topgoals必须',
  'topassists' => 'topassists必须',
  'topcards' => 'topcards必须',
  'injuries' => 'injuries必须',
);

    // 验证字段的别名
    protected $validate_alias = array (
  'topgoals' => 'topgoals',
  'topassists' => 'topassists',
  'topcards' => 'topcards',
  'injuries' => 'injuries',
);
    protected $validate_type = array (
  'add' => 
  array (
    0 => 'topgoals',
    1 => 'topassists',
    2 => 'topcards',
    3 => 'injuries',
  ),
  'edit' => 
  array (
    0 => 'topgoals',
    1 => 'topassists',
    2 => 'topcards',
    3 => 'injuries',
  ),
);

}