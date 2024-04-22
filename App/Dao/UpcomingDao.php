<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UpcomingModel;

class UpcomingDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UpcomingModel::class;
    }
}
