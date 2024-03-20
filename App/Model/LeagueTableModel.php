<?php

namespace App\Model;


class LeagueTableModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_league_table';
    protected $fields    = 'id,create_time,update_time,`season`,`overall`,`home`,`away`';
    // 验证规则
    protected $validate_rules = array(
        'season'  => 'required|notEmpty',
        'overall' => 'required|notEmpty',
        'home'    => 'required|notEmpty',
        'away'    => 'required|notEmpty',
    );

    // 验证错误消息提示
    protected $validate_messages = array(
        'season'  => 'season必须',
        'overall' => 'overall必须',
        'home'    => 'home必须',
        'away'    => 'away必须',
    );

    // 验证字段的别名
    protected $validate_alias = array(
        'season'  => 'season',
        'overall' => 'overall',
        'home'    => 'home',
        'away'    => 'away',
    );
    protected $validate_type  = array(
        'add'  =>
            array(
                0 => 'season',
                1 => 'overall',
                2 => 'home',
                3 => 'away',
            ),
        'edit' =>
            array(
                0 => 'season',
                1 => 'overall',
                2 => 'home',
                3 => 'away',
            ),
    );

    //获取器
    protected function getSeasonAttr($value, $data)
    {
        return json_decode($value,1);
    }
    //获取器
    protected function getOverallAttr($value, $data)
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
    protected function setSeasonAttr($value, $data)
    {
        return is_array($value) ? $value : json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    //获取器
    protected function setOverallAttr($value, $data)
    {
        return is_array($value) ? $value : json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    //获取器
    protected function setHomeAttr($value, $data)
    {
        return is_array($value) ? $value : json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    //获取器
    protected function setAwayAttr($value, $data)
    {
        return is_array($value) ? $value : json_encode($value,JSON_UNESCAPED_UNICODE);
    }

}