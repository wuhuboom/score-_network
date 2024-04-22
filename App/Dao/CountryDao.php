<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\CountryModel;

class CountryDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return CountryModel::class;
    }
}
