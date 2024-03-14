<?php

namespace App\Model;

/**
 * Class TdOrderModel
 * Create With Automatic Generator
 * @property $id          int |
 * @property $contents    string | 内容
 * @property $type_id     int | 类型ID
 * @property $wechat_id   int | 微信ID
 * @property $status      int | 1待处理 2已处理
 * @property $result      string | 处理结果
 * @property $create_time int | 11
 * @property $update_time int |
 * @property $user_id     int | 提交人
 */
class TrackerPointModel extends \App\Model\BaseModel
{
	protected $tableName = 'td_api_tracker_point_list';

}

