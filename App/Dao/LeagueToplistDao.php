<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\LeagueToplistModel;

class LeagueToplistDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return LeagueToplistModel::class;
    }
    //关联查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('lt')
                      ->join('td_league l', 'l.id=lt.league_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
