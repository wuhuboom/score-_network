<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\ServiceModel;

class ServiceDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return ServiceModel::class;
    }

}
