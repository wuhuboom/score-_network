<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\PlayerModel;

class PlayerDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return PlayerModel::class;
    }
}
