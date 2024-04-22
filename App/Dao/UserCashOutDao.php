<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UserCashOutModel;

class UserCashOutDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UserCashOutModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('c')
                      ->join('td_user u', 'u.id=c.user_id', 'LEFT')
                      ->join('td_user_bank bank', 'bank.id=c.user_bank_id', 'LEFT')
                      ->join('td_admins admin', 'admin.uid=c.admin_id', 'LEFT')
                      ->join('td_pay_way pay', 'pay.id=c.payway_id', 'LEFT');

        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
