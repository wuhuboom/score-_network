<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\SmsTemplateModel;


class SmsTemplateDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return SmsTemplateModel::class;
    }
}
