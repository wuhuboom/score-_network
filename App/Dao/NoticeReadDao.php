<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\NoticeReadModel;

class NoticeReadDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return NoticeReadModel::class;
    }
}
