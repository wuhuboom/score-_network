<?php
namespace App\Model;


class UserModel extends BaseModel
{
    protected $tableName = 'td_user';
    protected $fields = 'id,username,nickname,status,sort,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'username' => 'required|notEmpty',
        'password' => 'required|notEmpty',
        'nickname' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'username' => 'account must',
        'password' => 'password must',
        'nickname' => 'nickname must',
        'status'   => 'status must',

    ];

    // 验证字段的别名
    protected $validate_alias = [
        'username' => '登录账号必须填写',
        'password' => '登录密码必须填写',
        'nickname' => '昵称必须填写',

    ];
    protected $validate_type = [
        'add' => ['username','password','nickname','avatar'],
        'edit' => ['username','nickname','avatar'],
        'register' => ['username','password','nickname','openid'],
        'login' => ['username','password'],
    ];

}