<?php

namespace App\Model;

class BaseModel extends \EasySwoole\ORM\AbstractModel
{
	public $host = '';

    //查询结果返回数组
    public function select(){
        $data  = [];
        $model = $this->all();
        foreach ($model as $key => $one) {
            $data[] = $one->toArray(false, false);
        }
        return is_object($data) ? $data->toArray() : $data;
    }

    //单条数据查询返回数据
    public function find(){
        $data = $this->get();
        return is_object($data)?$data->toArray(false,false):$data;
    }

	/**
	 * 插入、更新时验证数据
	 */
	public  function validateData($data, $type = '')
	{
		$rules = $this->validate_rules;
		$messages = $this->validate_messages;
		$alias = $this->validate_alias;

		//  获取需要验证的字段
		if (!empty($type) && isset($this->validate_type[$type])) {
			$validate_fields = $this->validate_type[$type];
			foreach ($rules as $k => $v) {
				//移除不需要验证的字段
				if (!in_array($k, $validate_fields)) {
					unset($rules[$k]);
				}
			}
		}

		//  验证数据
		$validate = \EasySwoole\Validate\Validate::make($rules, $messages, $alias);
		if ($validate->validate($data)) {
			return true;
		} else {
			return $validate->getError()->__toString();
		}
	}

    public function orders(...$args)
    {
        $orders = arr