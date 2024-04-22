<?php


namespace App\Model;


use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class PosterModel extends BaseModel
{
    protected $tableName = 'td_poster';
    protected $fields = 'id,name,image,left,top,width,height,sort,create_time,update_time,remark';
    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',
        'image' => 'required|notEmpty',
        'left' => 'required|notEmpty',
        'top' => 'required|notEmpty',
        'width' => 'required|notEmpty',
        'height' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name' => '海报名称必须',
        'image' => '海报必须上传',
        'left' => '二维码左侧起始位置坐标必须',
        'top' => '二维码开始顶部起始位置坐标必须',
        'width' => '二维码宽度必须',
        'height' => '二维码高度必须',


    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name' => '海报名称必须',
        'image' => '海报必须上传',
        'left' => '二维码左侧起始位置坐标必须',
        'top' => '二维码开始顶部起始位置坐标必须',
        'width' => '二维码宽度必须',
        'height' => '二维码高度必须',

    ];
    protected $validate_type = [
        'add' => ['name', 'image', 'left', 'top', 'width', 'height'],
        'edit' => ['name', 'image', 'left', 'top', 'width', 'height']
    ];

}