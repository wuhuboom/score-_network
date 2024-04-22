<?php
declare(strict_types=1);
namespace App\Service;

use App\Dao\UserCashOutDao;

class UserCashOutService extends BaseService
{
    /**
     * 实例化服务
     * Service constructor.
     *
     * @param UserCashOutDao $dao
     */
    public function __construct(UserCashOutDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 根据名称获取单条数据
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
