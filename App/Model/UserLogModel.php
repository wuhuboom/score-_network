<?php
namespace App\Model;


class UserLogModel extends BaseModel
{
    protected $tableName = 'td_user_log';
    protected $fields = 'id,user_id,ip,country,province,city,create_time';
    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'ip' => 'required|notEmpty',
        'country' => 'required|notEmpty',
        'province' => 'required|notEmpty',
        'city' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
	    'user_id'  => '用户ID必须',
	    'ip'       => '登录IP必须',
	    'country'  => '国家必须',
	    'province' => '身份必须',
	    'city'     => '城市必须填写'
    ];

    // 验证字段的别名
    protected $validate_alias = [
	    'user_id'  => '用户ID必须',
	    'ip'       => '登录IP必须',
	    'country'  => '国家必须',
	    'province' => '身份必须',
	    'city'     => '城市必须填写'
    ];
    protected $validate_type = [
        'add' => ['user_id','ip','country','province','city'],
        'edit' => ['user_id','ip','country','province','city'],
    ];

}