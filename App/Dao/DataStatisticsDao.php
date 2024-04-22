<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\DataStatisticsModel;

class DataStatisticsDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return DataStatisticsModel::class;
    }
}
