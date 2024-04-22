<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\ApiRequestRecordModel;

class ApiRequestRecordDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return ApiRequestRecordModel::class;
    }

	//关联查询
	public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
		$model = $this->selectModel($where, $field, $page, $limit, $order, $with)
			->alias('a')
			->join('td_bets_api b', 'b.id=a.bets_api_id', 'LEFT');
		$list = $model->select();
		return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
	}
}
