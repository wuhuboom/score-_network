<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\VipModel;

class VipDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return VipModel::class;
    }
}
