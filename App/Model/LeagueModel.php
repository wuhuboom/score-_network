<?php
namespace App\Model;

class LeagueModel extends BaseModel
{
    protected $tableName = 'td_league';
    protected $fields = 'id,name,cc,has_leaguetable,has_toplist,create_time,update_time';
    // 验证规则
	protected $validate_rules = [
		'name' => 'required|notEmpty',
		'cc'   => 'required|notEmpty',
	];

	// 验证错误消息提示
	protected $validate_messages = [
		'name' => '联赛名称必须填写',
		'cc'   => '联赛简称必须填写',
		'has_leaguetable'   => '联赛表格has',
		'has_toplist'   => '联赛排名',
	];

	// 验证字段的别名
	protected $validate_alias = [
		'name' => '联赛名称必须填写',
		'cc'   => '联赛简称必须填写',
		'has_leaguetable'   => '联赛表格has',
		'has_toplist'   => '联赛排名',
	];
    protected $validate_type = [
        'add' => ['name','cc','has_leaguetable','has_toplist'],
        'edit' => ['name','cc','has_leaguetable','has_toplist'],
    ];

}