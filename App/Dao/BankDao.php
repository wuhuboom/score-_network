<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\BankModel;

class BankDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return BankModel::class;
    }
}
