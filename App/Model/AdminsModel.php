<?php


namespace App\Model;


use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class AdminsModel extends BaseModel
{
    protected $tableName = 'td_admins';

    protected $fields = 'uid,username,password,id_card,tel,status,avatar,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'username' => 'required|notEmpty',
        'password' => 'required|notEmpty',
        'id_card' => 'required|notEmpty',
        'tel' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'username' => '账号必须填写',
        'password' => '密码必须填写',
        'id_card' => '身份证号必须填写',
        'tel' => '身份证号必须填写',
        'reseller_ids' => '所属经销商必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'username' => '账号必须填写',
        'password' => '密码必须填写',
        'id_card' => '身份证号必须填写',
        'tel' => '身份证号必须填写',
        'reseller_ids' => '所属经销商必须',
    ];
    protected $validate_type = [
        'add' => [
            'username',
            'password',
            'realname',
            'id_card',
            'tel',
            'reseller_ids'
        ],
        'edit' => [
            'username',
            'id_card',
            'realname',
            'tel',
            'reseller_ids'
        ]
    ];


    //获取器
    protected function getCreateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    protected function getUpdateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    protected function getResellerIdsAttr($value, $data)
    {
        return $value?explode(',',$value):[];
    }


}