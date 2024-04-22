<?php
namespace App\Model;


class ServiceModel extends BaseModel
{
    protected $tableName = 'td_service';
    protected $fields = 'id,agent_id,code,name,invitation_code,is_generate_account,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'WhatsApp' => 'required|notEmpty',
        'name' => 'required|notEmpty',
        'start_time' => 'required|notEmpty',
        'end_time' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'WhatsApp'   => 'WhatsApp必须',
        'name'       => '客服名称必须',
        'start_time' => '工作开始时间必须',
        'end_time'   => '工作结束时间必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'WhatsApp'   => 'WhatsApp必须',
        'name'       => '客服名称必须',
        'start_time' => '工作开始时间必须',
        'end_time'   => '工作结束时间必须',
    ];
    protected $validate_type = [
        'add'  => ['WhatsApp','name','start_time','end_time'],
        'edit' => ['WhatsApp','name','start_time','end_time']
    ];


}