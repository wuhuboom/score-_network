<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\InplayModel;

class InplayDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return InplayModel::class;
    }

	//关联赛事赔率查询
	public function joinOddsList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
		$model = $this->selectModel($where, $field, $page, $limit, $order, $with)
			->alias('i')
			->join('td_odds o', 'i.id=o.event_id', 'LEFT');
		$list = $model->select();
		return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
	}
}
