<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\CategoryDao;
class CategoryService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     * @param CategoryDao $dao
     */
    public function __construct(CategoryDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 根据名称获取单条数据
     *
     * @param string $name
     *
     * @return CategoryDao|\App\Model\BaseModel|array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|null
     */
    public function findByName(string $name)
    {
        return $this->dao->getOne(['name'=>$name]);
    }
}
