<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TeamMembersModel;

class TeamMembersDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TeamMembersModel::class;
    }

	//关联查询
	public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
		$model = $this->selectModel($where, $field, $page, $limit, $order, $with)
			->alias('tm')
			->join('td_team t', 't.id=tm.team_id', 'LEFT');
		$list = $model->select();
		return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
	}
}
