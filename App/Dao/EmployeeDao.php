<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\EmployeeModel;

class EmployeeDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return EmployeeModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('e')
                      ->join('td_agent a', 'a.id=e.agent_id', 'LEFT')
                      ->join('td_user u', 'u.id=e.user_id', 'LEFT')
                      ->join('td_admins admin', 'admin.uid=e.admin_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
