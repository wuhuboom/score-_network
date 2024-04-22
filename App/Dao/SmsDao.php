<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\SmsModel;


class SmsDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return SmsModel::class;
    }
}
