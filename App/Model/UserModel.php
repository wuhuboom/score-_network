<?php
namespace App\Model;


class UserModel extends BaseModel
{
    protected $tableName = 'td_user';
    protected $fields = 'id,username,nickname,status,sort,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'username' => 'required|notEmpty|length:10',
        'password' => 'required|notEmpty',
        'nickname' => 'required|notEmpty',
        'avatar' => 'required|notEmpty',
        'invitation_code' => 'required|notEmpty',
        'code' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'username' => 'account must be filled in',
        'password' => 'password must be filled in',
        'nickname' => 'nickname must be filled in',
        'avatar'   => 'avatar must be filled in',
        'invitation_code' => 'invitation_code must be filled in',
        'code' => 'code must be filled in',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'username' => 'account must be filled in',
        'password' => 'password must be filled in',
        'nickname' => 'nickname must be filled in',
        'avatar'   => 'avatar must be filled in',
        'invitation_code' => 'invitation_code must be filled in',
        'code' => 'code must be filled in',
    ];
    protected $validate_type = [
        'add' => ['username','password','nickname','avatar'],
        'edit' => ['username','nickname','avatar'],
        'register' => ['username','password','invitation_code','code'],
        'login' => ['username','password'],
        'forget' => ['username','password','code'],
    ];

}