<?php
/**
 * Created by PhpStorm.
 * User: Double-jin
 * Date: 2022-04-23
 * Email: 283366402@qq.com
 */

namespace App\Model;


class UserBalanceDetailsModel extends BaseModel
{
    protected $tableName = 'td_user_balance_details';
    protected $fields = 'id,title,type,amount,remaining_amount,create_time,update_time';
    // 验证规则
    protected $validate_rules = [
        'type' => 'required|notEmpty',
        'title' => 'required|notEmpty',
        'amount' => 'required|notEmpty',


    ];

    // 验证错误消息提示
    protected $validate_messages = [
    ];

    // 验证字段的别名
    protected $validate_alias = [

    ];
    protected $validate_type = [
        'add' => ['title','type','amount','remaining_amount'],
        'edit' => ['title','type','amount','remaining_amount'],

    ];

}