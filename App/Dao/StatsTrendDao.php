<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\StatsTrendModel;

class StatsTrendDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return StatsTrendModel::class;
    }
}
