<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\UserModel;

class UserDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return UserModel::class;
    }
}
