<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\OrderModel;

class OrderDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return OrderModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('o')
                      ->join('td_user u', 'u.id=o.user_id', 'LEFT')
                      ->join('td_product p', 'p.id=o.product_id', 'LEFT')
	                  ->join('td_vip v', 'v.id=p.vip_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
