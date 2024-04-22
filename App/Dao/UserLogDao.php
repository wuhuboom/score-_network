<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UserLogModel;

class UserLogDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UserLogModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('l')
                      ->join('td_user u', 'u.id=l.user_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount(), 'sql' => $model->lastQuery()->getLastPrepareQuery()];
    }
}
