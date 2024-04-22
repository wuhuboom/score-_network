<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\InplayModel;

class InplayDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return InplayModel::class;
    }
}
