<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\EndedModel;

class EndedDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return EndedModel::class;
    }
}
