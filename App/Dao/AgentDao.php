<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\AgentModel;

class AgentDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return AgentModel::class;
    }

    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('a')
                      ->join('td_user u', 'u.id=a.user_id', 'LEFT')
                      ->join('td_admins admin', 'admin.uid=a.admin_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
