<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\OddsModel;

class OddsDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return OddsModel::class;
    }
}
