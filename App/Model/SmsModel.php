<?php
/**
 * Created by PhpStorm.
 * User: tudou
 * Date: 2022-04-01
 * Email: 283366402@qq.com
 */

namespace App\Model;


class SmsModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_sms';
    protected $fields = 'id,tel,code,contents,ip,is_check,expire_time,create_time,status';
    // 验证规则
    protected $validate_rules = array (
      'tel' => 'required|notEmpty',
      'contents' => 'required|notEmpty',
      'status' => 'required|notEmpty',
    );
    // 验证错误消息提示
    protected $validate_messages = ['tel'=>'电话必须','contents'=>'发送内容必须','status'=>'发送状态必须'];
    // 验证字段的别名
    protected $validate_alias = ['tel'=>'电话必须','contents'=>'发送内容必须','status'=>'发送状态必须'];
    protected $validate_type = ['add'=>['tel','status','contents',],'edit'=>['tel','status','contents'],];

}