<?php


namespace App\Model;


use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class SystemModel extends BaseModel
{
    protected $tableName = 'td_system';

    protected $fields = 'id,title,logo,keywords,description,copyright,cn_copyright,technical_support,beian,footer_image,contact,tel,address,email,fax,update_time';
    // 验证规则
    protected $validate_rules = [
        'title' => 'required|notEmpty',
        'footer' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'title' => '网站名称必须填写',
        'footer' => '底部版权必须填写',


    ];

    // 验证字段的别名
    protected $validate_alias = [
        'title' => '网站名称必须填写',
        'footer' => '底部版权必须填写',

    ];
    protected $validate_type = [
        'add' => [
            'title',

        ],
        'edit' => [
            'title',

        ]
    ];
    //任务配置
    protected function getTasksConfigAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }
    //产品购买配置
    protected function getProductConfigAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }
    //充值配置
    protected function getRechargeConfigAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }
    //提现配置
    protected function getWithdrawalConfigAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }
    //客户配置
    protected function getCustomerConfigAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }


}