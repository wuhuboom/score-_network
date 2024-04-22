<?php
namespace App\Model;

class FileManagementModel extends BaseModel
{
    protected $tableName = 'td_file_management';
    protected $fields = 'id,category,file_url,file_type,file_name,file_path,file_size,file_extension,is_oss,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'category' => 'required|notEmpty',
        'file_type' => 'required|notEmpty',
        'file_url' => 'required|notEmpty',
        'file_name' => 'required|notEmpty',
        'file_path' => 'required|notEmpty',
        'file_size' => 'required|notEmpty',
        'file_extension' => 'required|notEmpty',
        'is_oos' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'category' => '所属分类必须',
        'file_url' => '文件访问路径',
        'file_type' => '文件类型必须',
        'file_name' => '文件名称必须',
        'file_path' => '文件路径必须',
        'file_size' => '文件大小必须',
        'file_extension' => '文件后缀必须',
        'is_oss' => '是否上传OOS必须',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'category' => '所属分类必须',
        'file_url' => '文件访问路径',
        'file_type' => '文件类型必须',
        'file_name' => '文件名称必须',
        'file_path' => '文件存储路径必须',
        'file_size' => '文件大小必须',
        'file_extension' => '文件后缀必须',
        'is_oss' => '是否上传OOS必须',
    ];
    protected $validate_type = [
        'add' => ['category','file_url', 'file_type','file_name','file_path','file_size','file_extension'],
        'edit' => ['category','file_url', 'file_type','file_name','file_path','file_size','file_extension']
    ];

    protected function getFileSizeAttr($value, $data)
    {
        return empty($value) ? 0 : round($value/1024,2);
    }
}