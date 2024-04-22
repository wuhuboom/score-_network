<?php
namespace App\Model;

class CountryModel extends BaseModel
{
    protected $tableName = 'td_country';
    protected $fields = 'id,name,cc,sort,create_time,update_time';
    // 验证规则
	protected $validate_rules = [
		'name' => 'required|notEmpty',
		'cc'   => 'required|notEmpty',
	];

	// 验证错误消息提示
	protected $validate_messages = [
		'name' => '国家名称必须填写',
		'cc'   => '国家简称必须填写',
	];

	// 验证字段的别名
	protected $validate_alias = [
		'name' => '国家名称必须填写',
		'cc'   => '国家简称必须填写',
	];
    protected $validate_type = [
        'add' => ['name','cc'],
        'edit' => ['name','cc'],
    ];

}