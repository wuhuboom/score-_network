<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\TasksModel;

class TasksDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return TasksModel::class;
    }
}
