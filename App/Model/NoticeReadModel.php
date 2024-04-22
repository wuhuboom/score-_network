<?php
namespace App\Model;

use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class NoticeReadModel extends BaseModel
{
    protected $tableName = 'td_notice_read';
    protected $fields = 'id,user_id,notice_ic,create_time';
    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',
        'type' => 'required|notEmpty',
    ];

}