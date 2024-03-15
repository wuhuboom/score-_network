<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\BetsApiModel;

class BetsApiDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return BetsApiModel::class;
    }
}
