<?php

namespace App\Model;


class OddsModel extends \App\Model\BaseModel
{
	protected $tableName = 'td_odds';
	protected $fields    = 'id,create_time,update_time,`event_id`,`stats`,`odds`';
	// 验证规则
	protected $validate_rules = array(
		'event_id' => 'required|notEmpty',
		'stats'    => 'required|notEmpty',
		'odds'     => 'required|notEmpty',
	);

	// 验证错误消息提示
	protected $validate_messages = array(
		'event_id' => 'event_id必须',
		'stats'    => 'stats必须',
		'odds'     => 'odds必须',
	);

	// 验证字段的别名
	protected $validate_alias = array(
		'event_id' => 'event_id',
		'stats'    => 'stats',
		'odds'     => 'odds',
	);
	protected $validate_type  = array(
		'add'  =>
			array(
				0 => 'event_id',
				1 => 'stats',
				2 => 'odds',
			),
		'edit' =>
			array(
				0 => 'event_id',
				1 => 'stats',
				2 => 'odds',
			),
	);
	//获取器
	protected function getOddsAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//写入
	protected function setOddsAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function getStatsAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//写入
	protected function setStatsAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
}