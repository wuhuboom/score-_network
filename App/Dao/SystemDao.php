<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\SystemModel;


class SystemDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return SystemModel::class;
    }
}
