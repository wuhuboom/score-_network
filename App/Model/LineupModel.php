<?php

namespace App\Model;


class LineupModel extends \App\Model\BaseModel
{
	protected $tableName = 'td_lineup';
	protected $fields    = 'id,create_time,update_time,`event_id`,`home`,`away`';
	// 验证规则
	protected $validate_rules = array(
		'event_id' => 'required|notEmpty',
		'home'     => 'required|notEmpty',
		'away'     => 'required|notEmpty',
	);

	// 验证错误消息提示
	protected $validate_messages = array(
		'event_id' => 'event_id必须',
		'home'     => 'home必须',
		'away'     => 'away必须',
	);

	// 验证字段的别名
	protected $validate_alias = array(
		'event_id' => 'event_id',
		'home'     => 'home',
		'away'     => 'away',
	);
	protected $validate_type  = array(
		'add'  =>
			array(
				0 => 'event_id',
				1 => 'home',
				2 => 'away',
			),
		'edit' =>
			array(
				0 => 'event_id',
				1 => 'home',
				2 => 'away',
			),
	);
	protected function getHomeAttr($value, $data)
	{
		return json_decode($value,1);
	}
	protected function setHomeAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	protected function getAwayAttr($value, $data)
	{
		return json_decode($value,1);
	}
	protected function setAwayAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
}