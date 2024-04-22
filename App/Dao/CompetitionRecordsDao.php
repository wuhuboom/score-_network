<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\CompetitionRecordsModel;

class CompetitionRecordsDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return CompetitionRecordsModel::class;
    }
}
