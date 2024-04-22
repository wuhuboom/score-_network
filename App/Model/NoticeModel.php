<?php
namespace App\Model;

use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class NoticeModel extends BaseModel
{
    protected $tableName = 'td_notice';
    protected $fields = 'id,is_alert,title,author,contents,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'is_alert' => 'required|notEmpty',
        'title' => 'required|notEmpty',
        'author' => 'required|notEmpty',
        'contents' => 'required|notEmpty',
    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'is_alert' => '是否弹窗必须选择',
        'title' => '公告标题必须填写',
        'author' => '发布者必须填写',
        'contents' => '公告内容必须填写',
    ];

    // 验证字段的别名
    protected $validate_alias = [
        'is_alert' => '是否弹窗必须选择',
        'title' => '公告标题必须填写',
        'author' => '发布者必须填写',
        'contents' => '公告内容必须填写',
    ];
    protected $validate_type = [
        'add'  => ['is_alert', 'title', 'author', 'contents'],
        'edit' => ['is_alert', 'title', 'author', 'contents']
    ];

}