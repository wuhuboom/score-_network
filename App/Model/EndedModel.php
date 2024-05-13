<?php

namespace App\Model;

class EndedModel extends \App\Model\BaseModel
{
	protected $tableName = 'td_ended';
	protected $fields    = 'id,create_time,update_time,`sport_id`,`time`,`time_status`,`league`,`home`,`away`,`ss`,`scores`,`stats`,`bet365_id`,`timer`';
	// 验证规则
	protected $validate_rules = array(
		'sport_id'    => 'required|notEmpty',
		'time'        => 'required|notEmpty',
		'time_status' => 'required|notEmpty',
		'league'      => 'required|notEmpty',
		'home'        => 'required|notEmpty',
		'away'        => 'required|notEmpty',
		'ss'          => 'required|notEmpty',
		'scores'      => 'required|notEmpty',
		'stats'       => 'required|notEmpty',
		'bet365_id'   => 'required|notEmpty',
		'timer'       => 'required|notEmpty',
	);

	// 验证错误消息提示
	protected $validate_messages = array(
		'sport_id'    => 'sport_id必须',
		'time'        => 'time必须',
		'time_status' => 'time_status必须',
		'league'      => 'league必须',
		'home'        => 'home必须',
		'away'        => 'away必须',
		'ss'          => 'ss必须',
		'scores'      => 'scores必须',
		'stats'       => 'stats必须',
		'bet365_id'   => 'bet365_id必须',
		'timer'       => 'timer必须',
	);

	// 验证字段的别名
	protected $validate_alias = array(
		'sport_id'    => 'sport_id',
		'time'        => 'time',
		'time_status' => 'time_status',
		'league'      => 'league',
		'home'        => 'home',
		'away'        => 'away',
		'ss'          => 'ss',
		'scores'      => 'scores',
		'stats'       => 'stats',
		'bet365_id'   => 'bet365_id',
		'timer'       => 'timer',
	);
	protected $validate_type  = array(
		'add'  =>
			array(
				0  => 'sport_id',
				1  => 'time',
				2  => 'time_status',
				3  => 'league',
				4  => 'home',
				5  => 'away',
				6  => 'ss',
//				7  => 'scores',
//				8  => 'stats',
//				9  => 'bet365_id',
//				10 => 'timer',
			),
		'edit' =>
			array(
				0  => 'sport_id',
				1  => 'time',
				2  => 'time_status',
				3  => 'league',
				4  => 'home',
				5  => 'away',
				6  => 'ss',
				7  => 'scores',
				8  => 'stats',
				9  => 'bet365_id',
				10 => 'timer',
			),
	);

	//获取器
	protected function getTimeAttr($value, $data)
	{
		return date('Y-m-d H:i:s',$value);
	}
	//获取器
	protected function getLeagueAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//获取器
	protected function getScoresAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//获取器
	protected function getStatsAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//获取器
	protected function getHomeAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//获取器
	protected function getAwayAttr($value, $data)
	{
		return json_decode($value,1);
	}
	//获取器
	protected function setLeagueAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function setScoresAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function setStatsAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function setTimerAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function setHomeAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
	//获取器
	protected function setAwayAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
}