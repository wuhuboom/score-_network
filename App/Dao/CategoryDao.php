<?php
declare(strict_types=1);
namespace App\Dao;
use App\Model\CategoryModel;

class CategoryDao extends \App\Dao\BaseDao
{
    protected function setModel(): string
    {
        return CategoryModel::class;
    }
}
