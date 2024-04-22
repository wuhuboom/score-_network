<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\CategoryDao;
use App\Dao\ProductDao;

class ShopService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param ProductDao $dao
     */
    public function __construct(ProductDao $dao)
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
    public function findById(int $id)
    {
        return $this->dao->get($id);
    }
}
