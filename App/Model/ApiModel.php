<?php
namespace App\Model;


class ApiModel extends BaseModel
{
    protected $tableName = 'td_api';
    protected $fields = 'id,group_id,sort,title,path,desc,method,request_params,response_params,success_examples,fail_examples,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'group_id' => 'required|notEmpty',
        'title' => 'required|notEmpty',
        'path' => 'required|notEmpty',
        'desc' => 'required|notEmpty',
        'method' => 'required|notEmpty',
        'request_params' => 'required|notEmpty',
        'response_params' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'group_id' => '分组必须',
        'title' => '接口名称必须',
        'path' => '请求路径必须',
        'desc' => '接口描述',
        'method' => '请求方式',
        'request_params' => '请求参数必须',
        'response_params' => '响应参数必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'group_id' => '分组必须',
        'title' => '接口名称必须',
        'path' => '请求路径必须',
        'desc' => '接口描述',
        'method' => '请求方式',
        'request_params' => '请求参数必须',
        'response_params' => '响应参数必须',
    ];
    protected $validate_type = [
        'add' => ['group_id','sort','title','path','desc','method','request_params','response_params'],
        'edit' => ['group_id','sort','title','path','desc','method','request_params','response_params']
    ];
    //获取器
    protected function getRequestParamsAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }
    //获取器
    protected function getResponseParamsAttr($value, $data)
    {
        return empty($value) ? [] : json_decode($value,1);
    }


}