<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\LineupModel;

class LineupDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return LineupModel::class;
    }
}
