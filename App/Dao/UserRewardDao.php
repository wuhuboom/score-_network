<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UserRewardModel;

class UserRewardDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UserRewardModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('r')
                      ->join('td_user u', 'u.id=r.user_id', 'LEFT')
                      ->join('td_admins admin', 'admin.uid=r.admin_id', 'LEFT');

        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
