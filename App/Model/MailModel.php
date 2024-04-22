<?php
namespace App\Model;


class MailModel extends BaseModel
{
    protected $tableName = 'td_mail';
    protected $fields = 'id,user_id,admin_id,title,contents,is_read,read_time,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'admin_id' => 'required|notEmpty',
        'title' => 'required|notEmpty',
        'contents' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id'  => '收信人必须选择',
        'admin_id' => '发布人必须选择',
        'title'    => '信件标题必须填写',
        'contents' => '信件内容必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id'  => '收信人必须选择',
        'admin_id' => '发布人必须选择',
        'title'    => '信件标题必须填写',
        'contents' => '信件内容必须填写',
    ];
    protected $validate_type = [
        'add' => ['user_id','admin_id','title','contents'],
        'edit' => ['user_id','admin_id','title','contents'],
    ];

}