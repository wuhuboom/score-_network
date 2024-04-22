<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\MailModel;

class MailDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return MailModel::class;
    }
    //关联查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('m')
                      ->join('td_user u', 'u.id=m.user_id', 'LEFT')
                      ->join('td_agent a', 'a.id=u.agent_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
