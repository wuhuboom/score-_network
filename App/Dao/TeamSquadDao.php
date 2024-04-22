<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TeamSquadModel;

class TeamSquadDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TeamSquadModel::class;
    }
	//关联查询
	public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
		$model = $this->selectModel($where, $field, $page, $limit, $order, $with)
			->alias('tq')
			->join('td_team t', 't.id=tq.team_id', 'LEFT');
		$list = $model->select();
		return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
	}
}
