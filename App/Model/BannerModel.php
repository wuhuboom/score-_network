<?php
namespace App\Model;

use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class BannerModel extends BaseModel
{
    protected $tableName = 'td_banner';
    protected $fields = 'id,title,path,image,sort,create_time,update_time';

    // 验证规则
    protected $validate_rules = [
        'title' => 'required|notEmpty',
        'path' => 'required|notEmpty',
        'image' => 'required|notEmpty',
        'platform_type' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'title' => '名称必须',
        'path' => '轮播图地址必须',
        'image' => '轮播图图片必须',
        'bg' => '背景图片必须',
        'platform_type' => '客户端类型必须',

    ];

    // 验证字段的别名
    protected $validate_alias = [
        'title' => '轮播图名称必须',
        'path' => '轮播图地址必须',
        'image' => '轮播图图片必须',
        'bg' => '背景图片必须',
        'platform_type' => '客户端类型必须',
    ];
    protected $validate_type = [
        'add' => ['title', 'path','image','bg','platform_type'],
        'edit' => ['title', 'path','image','platform_type']
    ];

}