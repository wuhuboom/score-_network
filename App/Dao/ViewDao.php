<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\ViewModel;

class ViewDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return ViewModel::class;
    }
}
