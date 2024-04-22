<?php

namespace App\Model;


class ApiRequestRecordModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_api_request_record';
    protected $fields    = 'id,create_time,update_time,`event_id`,`sport_id`,`time`,`time_status`,`league`,`home`,`away`,`ss`,`scores`,`stats`,`extra`,`events`,`has_lineup`,`inplay_created_at`,`inplay_updated_at`,`confirmed_at`,`bet365_id`';
    // 验证规则
    protected $validate_rules = array(
        'api'          => 'required|notEmpty',
        'name'          => 'required|notEmpty',
        'bets_api_id'              => 'required|notEmpty',
        'result'       => 'required|notEmpty',
    );

    // 验证错误消息提示
    protected $validate_messages = array(
        'api'          => '请求地址必须',
        'bets_api_id'          => '接口ID必须',
        'name'              => '接口名称',
        'result'       => '请求结果',
    );

    // 验证字段的别名
    protected $validate_alias = array(
	    'api'          => '请求地址必须',
	    'bets_api_id'          => '接口ID必须',
	    'name'              => '接口名称',
	    'result'       => '请求结果',
    );
    protected $validate_type  = array(
        'add'  =>
            array(
                0  => 'api',
                1  => 'bets_api_id',
                2  => 'name',
                3  => 'result',
            ),
        'edit' =>
            array(
	            0  => 'api',
	            1  => 'bets_api_id',
	            2  => 'name',
	            3  => 'result',
            ),
    );
    protected function getResultAttr($value, $data)
    {
        return json_decode($value,1);
    }

    protected function setResultAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }

}