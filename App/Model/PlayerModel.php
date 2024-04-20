<?php

namespace App\Model;


class PlayerModel extends \App\Model\BaseModel
{
	protected $tableName = 'td_player';
	protected $fields    = 'id,create_time,update_time,`player`,`transfers`,`events`';
	// 验证规则
	protected $validate_rules = array(
		'player'    => 'required|notEmpty',
		'transfers' => 'required|notEmpty',
		'events'    => 'required|notEmpty',
	);

	// 验证错误消息提示
	protected $validate_messages = array(
		'player'    => 'player必须',
		'transfers' => 'transfers必须',
		'events'    => 'events必须',
	);

	// 验证字段的别名
	protected $validate_alias = array(
		'player'    => 'player',
		'transfers' => 'transfers',
		'events'    => 'events',
	);
	protected $validate_type  = array(
		'add'  =>
			array(
				0 => 'player',
				1 => 'transfers',
				2 => 'events',
			),
		'edit' =>
			array(
				0 => 'player',
				1 => 'transfers',
				2 => 'events',
			),
	);

	//获取器
	protected function getPlayerAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//写入
	protected function setPlayerAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function getTransfersAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//写入
	protected function setTransfersAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function getEventsAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//写入
	protected function setEventsAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}

}