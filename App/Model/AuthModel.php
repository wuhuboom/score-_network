<?php


namespace App\Model;


use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class AuthModel extends BaseModel
{
    protected $tableName = 'td_user_auth';

    //获取器
    protected function getCreateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }
    //获取器
    protected function getUpdateTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }


}