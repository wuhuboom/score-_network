<?php
namespace App\Model;


class SmsTemplateModel extends BaseModel
{
    protected $tableName = 'td_sms_template';
    protected $fields = 'id,type,sign,template_id,appsecret,appkey,contents,template_id,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'type'        => 'required|notEmpty',
        'appid'   => 'required|notEmpty',
        'appsecret'   => 'required|notEmpty',
        'appkey'      => 'required|notEmpty',
        'sign'        => 'required|notEmpty',
        'template_id' => 'required|notEmpty',
        'contents'    => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'type'        => '请选择短信模板类型',
        'appid'   => '请输入短信appid',
        'appsecret'   => '请输入短信appsecret',
        'appkey'      => '请输入短信APPKEY',
        'template_id' => '请输入短信模板ID',
        'sign'        => '请输入短信签名',
        'contents'    => '请输入短信模板样例',
    ];

// 验证字段的别名
    protected $validate_alias = [
        'type'        => '请选择短信模板类型',
        'appid'   => '请输入短信appid',
        'appsecret'   => '请输入短信appsecret',
        'appkey'      => '请输入短信APPKEY',
        'template_id' => '请输入短信模板ID',
        'sign'        => '请输入短信签名',
        'contents'    => '请输入短信模板样例',
    ];
    protected $validate_type = [
        'add' => ['type','appid' ,'appsecret' ,'appkey' ,'sign' ,'contents' ],
        'edit' => ['type','appid','appsecret' ,'appkey' ,'sign' ,'contents' ],
    ];



}