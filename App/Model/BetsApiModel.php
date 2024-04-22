<?php
namespace App\Model;

class BetsApiModel extends BaseModel
{
    protected $tableName = 'td_bets_api';
    protected $fields = 'id,name,api_url,doc_url,json_url,table_name,sort,create_time,update_time';
    // 验证规则
	protected $validate_rules = [
		'name' => 'required|notEmpty',
		'api_url'   => 'required|notEmpty',
		'doc_url'   => 'required|notEmpty',
		'json_url'   => 'required|notEmpty',
		'table_name'   => 'required|notEmpty',
	];

	// 验证错误消息提示
	protected $validate_messages = [
		'name'       => '接口名称必须填写',
		'api_url'    => '接口请求地址必须填写',
		'doc_url'    => '接口文档地址必须填写',
		'json_url'   => '结果json地址必须填写',
		'table_name' => '生成的MYSQL表格名称必须填写',
	];

	// 验证字段的别名
	protected $validate_alias = [
		'name'       => '接口名称必须填写',
		'api_url'    => '接口请求地址必须填写',
		'doc_url'    => '接口文档地址必须填写',
		'json_url'   => '结果json地址必须填写',
		'table_name' => '生成的MYSQL表格名称必须填写',
	];
    protected $validate_type = [
        'add' => ['name','api_url','doc_url','json_url','table_name'],
        'edit' => ['name','api_url','doc_url','json_url','table_name'],
    ];

}