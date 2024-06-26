<?php

namespace App\Model;


class LeagueToplistModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_league_toplist';
    protected $fields    = 'id,create_time,update_time,`topgoals`,`topassists`,`topcards`,`injuries`';
    // 验证规则
    protected $validate_rules = array(
        'topgoals'   => 'required|notEmpty',
        'topassists' => 'required|notEmpty',
        'topcards'   => 'required|notEmpty',
        'injuries'   => 'required|notEmpty',
    );

    // 验证错误消息提示
    protected $validate_messages = array(
        'topgoals'   => 'topgoals必须',
        'topassists' => 'topassists必须',
        'topcards'   => 'topcards必须',
        'injuries'   => 'injuries必须',
    );

    // 验证字段的别名
    protected $validate_alias = array(
        'topgoals'   => 'topgoals',
        'topassists' => 'topassists',
        'topcards'   => 'topcards',
        'injuries'   => 'injuries',
    );
    protected $validate_type  = array(
        'add'  =>
            array(
                0 => 'topgoals',
                1 => 'topassists',
                2 => 'topcards',
                3 => 'injuries',
            ),
        'edit' =>
            array(
                0 => 'topgoals',
                1 => 'topassists',
                2 => 'topcards',
                3 => 'injuries',
            ),
    );
    //获取器
    protected function getTopassistsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    //获取器
    protected function getTopgoalsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    //获取器
    protected function getTopcardsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    //获取器
    protected function getInjuriesAttr($value, $data)
    {
        return json_decode($value,1);
    }
    //获取器
    protected function setTopassistsAttr($value, $data)
    {
	    return is_array($value) ?   json_encode($value,JSON_UNESCAPED_UNICODE):$value;
    }
    //获取器
    protected function setTopgoalsAttr($value, $data)
    {
	    return is_array($value) ?   json_encode($value,JSON_UNESCAPED_UNICODE):$value;
    }
    //获取器
    protected function setTopcardsAttr($value, $data)
    {
        return is_array($value) ?   json_encode($value,JSON_UNESCAPED_UNICODE):$value;
    }
    //获取器
    protected function setInjuriesAttr($value, $data)
    {
	    return is_array($value) ?   json_encode($value,JSON_UNESCAPED_UNICODE):$value;
    }
}