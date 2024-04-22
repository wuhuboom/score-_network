<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UserModel;

class UserDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UserModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('u')
                      ->join('td_employee e', 'e.id=u.employee_id', 'LEFT')
                      ->join('td_agent a', 'a.id=u.agent_id', 'LEFT')
                      ->join('td_vip v', 'v.id=u.vip_id', 'LEFT');

        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
