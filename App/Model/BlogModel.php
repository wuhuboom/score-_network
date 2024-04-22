<?php
namespace App\Model;


class BlogModel extends BaseModel
{
    protected $tableName = 'td_blog';
    protected $fields = 'id,user_id,status,contents,is_img,image,reward_amount,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'user_id' => 'required|notEmpty',
        'status' => 'required|notEmpty',
        'contents' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'user_id' => '所属用户必须选择',
        'status' => '博客状态必须选择',
        'contents' => '博客内容必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'user_id' => '所属用户必须选择',
        'status' => '博客状态必须选择',
        'contents' => '博客内容必须填写',
    ];
    protected $validate_type = [
        'add'  => ['user_id','status','contents'],
        'edit' => ['user_id','status','contents'],
    ];

    //获取器
    protected function getImageAttr($value, $data)
    {
        return $value?json_decode($value,1):[];
    }
    /**
     * 自动写入
     */
    protected function setImageAttr($value, $data)
    {
        return is_array($value)?json_encode($value,JSON_UNESCAPED_UNICODE):$value;
    }
}