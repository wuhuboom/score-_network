<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\HistoryModel;

class HistoryDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return HistoryModel::class;
    }
}
