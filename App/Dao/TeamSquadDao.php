<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TeamSquadModel;

class TeamSquadDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TeamSquadModel::class;
    }
}
