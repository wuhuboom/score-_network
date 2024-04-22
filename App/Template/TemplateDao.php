<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\%sModel;

class %sDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return %sModel::class;
    }
}
