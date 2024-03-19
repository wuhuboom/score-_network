<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TeamMembersModel;

class TeamMembersDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TeamMembersModel::class;
    }
}
