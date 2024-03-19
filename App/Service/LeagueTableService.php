<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\LeagueTableModel;

class LeagueTableDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return LeagueTableModel::class;
    }
}
