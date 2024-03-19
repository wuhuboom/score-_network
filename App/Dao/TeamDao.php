<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TeamModel;

class TeamDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TeamModel::class;
    }
}
