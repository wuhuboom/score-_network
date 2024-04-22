<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\NoticeModel;

class NoticeDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return NoticeModel::class;
    }
}
