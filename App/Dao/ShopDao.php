<?php
declare(strict_types=1);
namespace App\Dao;
use App\Model\ShopModel;

class ShopDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return ShopModel::class;
    }
}
