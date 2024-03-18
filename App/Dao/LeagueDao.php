<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\LeagueModel;

class LeagueDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return LeagueModel::class;
    }
}
