<?php
/**
 * Created by PhpStorm.
 * User: Double-jin
 * Date: 2022-04-23
 * Email: 283366402@qq.com
 */

namespace App\Model;


class AreaModel extends BaseModel
{
    protected $tableName = 'td_area';

    protected $fields = 'id,type,name,sort,create_time,update_time';


    // 验证规则
    protected $validate_rules = [
        'name' => 'required|notEmpty',

    ];

    // 验证错误消息提示
    protected $validate_messages = [
        'name' => '地区名称必须',


    ];

    // 验证字段的别名
    protected $validate_alias = [
        'name' => '地区名称必须',

    ];
    protected $validate_type = [
        'add' => ['name' ],
        'edit' => ['name']
    ];

}