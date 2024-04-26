<?php

namespace App\Model;


class ViewModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_view';
    protected $fields    = 'id,create_time,update_time,`event_id`,`sport_id`,`time`,`time_status`,`league`,`home`,`away`,`ss`,`scores`,`stats`,`extra`,`events`,`has_lineup`,`inplay_created_at`,`inplay_updated_at`,`confirmed_at`,`bet365_id`';
    // 验证规则
    protected $validate_rules = array(
        'event_id'          => 'required|notEmpty',
        'sport_id'          => 'required|notEmpty',
        'time'              => 'required|notEmpty',
        'time_status'       => 'required|notEmpty',
        'league'            => 'required|notEmpty',
        'home'              => 'required|notEmpty',
        'away'              => 'required|notEmpty',
        'ss'                => 'required|notEmpty',
        'scores'            => 'required|notEmpty',
        'stats'             => 'required|notEmpty',
        'extra'             => 'required|notEmpty',
        'events'            => 'required|notEmpty',
        'has_lineup'        => 'required|notEmpty',
        'inplay_created_at' => 'required|notEmpty',
        'inplay_updated_at' => 'required|notEmpty',
        'confirmed_at'      => 'required|notEmpty',
        'bet365_id'         => 'required|notEmpty',
    );

    // 验证错误消息提示
    protected $validate_messages = array(
        'event_id'          => 'event_id必须',
        'sport_id'          => 'sport_id必须',
        'time'              => 'time必须',
        'time_status'       => 'time_status必须',
        'league'            => 'league必须',
        'home'              => 'home必须',
        'away'              => 'away必须',
        'ss'                => 'ss必须',
        'scores'            => 'scores必须',
        'stats'             => 'stats必须',
        'extra'             => 'extra必须',
        'events'            => 'events必须',
        'has_lineup'        => 'has_lineup必须',
        'inplay_created_at' => 'inplay_created_at必须',
        'inplay_updated_at' => 'inplay_updated_at必须',
        'confirmed_at'      => 'confirmed_at必须',
        'bet365_id'         => 'bet365_id必须',
    );

    // 验证字段的别名
    protected $validate_alias = array(
        'event_id'          => 'event_id',
        'sport_id'          => 'sport_id',
        'time'              => 'time',
        'time_status'       => 'time_status',
        'league'            => 'league',
        'home'              => 'home',
        'away'              => 'away',
        'ss'                => 'ss',
        'scores'            => 'scores',
        'stats'             => 'stats',
        'extra'             => 'extra',
        'events'            => 'events',
        'has_lineup'        => 'has_lineup',
        'inplay_created_at' => 'inplay_created_at',
        'inplay_updated_at' => 'inplay_updated_at',
        'confirmed_at'      => 'confirmed_at',
        'bet365_id'         => 'bet365_id',
    );
    protected $validate_type  = array(
        'add'  =>
            array(
                0  => 'event_id',
                1  => 'sport_id',
                2  => 'time',
                3  => 'time_status',
                4  => 'league',
                5  => 'home',
                6  => 'away',
                7  => 'ss',
                8  => 'scores',
                9  => 'stats',
                10 => 'extra',
                11 => 'events',
                12 => 'has_lineup',
                13 => 'inplay_created_at',
                14 => 'inplay_updated_at',
                15 => 'confirmed_at',
                16 => 'bet365_id',
            ),
        'edit' =>
            array(
                0  => 'event_id',
                1  => 'sport_id',
                2  => 'time',
                3  => 'time_status',
                4  => 'league',
                5  => 'home',
                6  => 'away',
                7  => 'ss',
                8  => 'scores',
                9  => 'stats',
                10 => 'extra',
                11 => 'events',
                12 => 'has_lineup',
                13 => 'inplay_created_at',
                14 => 'inplay_updated_at',
                15 => 'confirmed_at',
                16 => 'bet365_id',
            ),
    );
	protected function getTimerAttr($value, $data)
	{
		return json_decode($value,1);
	}
	protected function setTimerAttr($value, $data)
	{
		return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
	}
    protected function getLeagueAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function setLeagueAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
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
    protected function getScoresAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function setScoresAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function getStatsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function setStatsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function getExtraAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function setExtraAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function getEventsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function setEventsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
}