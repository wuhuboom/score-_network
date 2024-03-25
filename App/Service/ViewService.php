<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\ViewDao;

class ViewService extends BaseService
{
    /**
     * 实例化服务
     * CategoryService constructor.
     *
     * @param %sDao $dao
     */
    public function __construct(ViewDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取列表
     * @param string $name
     *
     * @return array
     */
    public function getLists(array $where = [], string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = [])
    {
        return $this->dao->selectList($where, $field , $page, $limit, $order, $with);
    }


    /**
     * 根据主键查询
     * @param int $id
     * @return bool
     */
    public function idExists($id)
    {
        return $this->dao->get($id);
    }
}
