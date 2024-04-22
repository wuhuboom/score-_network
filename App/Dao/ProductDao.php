<?php
declare(strict_types=1);
namespace App\Dao;
use App\Model\ProductModel;

class ProductDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return ProductModel::class;
    }
    //管理查询
    public function joinSelectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = []){
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with)
                      ->alias('p')
                      ->join('td_vip v', 'v.id=p.vip_id', 'LEFT');
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }
}
