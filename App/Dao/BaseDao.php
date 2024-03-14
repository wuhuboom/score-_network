<?php
declare(strict_types=1);
namespace App\Dao;

use App\Model\BaseModel;
use EasySwoole\Mysqli\QueryBuilder;

abstract class BaseDao
{
    /**
     * 获取当前模型
     * @return string
     */
    abstract protected function setModel(): string;

    /**
     * 获取模型
     * @return BaseModel
     * @throws \Exception
     */
    protected function getModel()
    {
        $modelClass = $this->setModel();
        if (!class_exists($modelClass)) {
            throw new \Exception("The class {$modelClass} not found.");
        }
        return new $modelClass();
    }

    /**
     * 获取主键
     * @return array|mixed|null
     * @throws \EasySwoole\ORM\Exception\Exception
     */
    protected function getPk()
    {
        return $this->getModel()->schemaInfo()->getPkFiledName();
    }

    /**
     * 获取表名
     * @return mixed
     * @throws \Exception
     */
    public function getTableName()
    {
        return $this->getModel()->getTableName();
    }

    /**
     * 根据条件获取一条数据
     * @param array       $where
     * @param string|null $field
     * @param array|null $with
     * @return BaseModel|array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|null
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function getOne(array $where, ?string $field = '*', array $with = [])
    {
        if ($field) {
            if ($field !== '*') {
                $field = explode(',', $field);
            }
        }
        return $this->get($where, $field, $with);
    }

    /**
     * 获取一条数据
     * @param            $id
     * @param array|null $field
     * @param array|null $with
     * @return BaseModel|array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|null
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function get($id, $field = '*', ?array $with = [])
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->getPk() => $id];
        }

        $model = $this->getModel();

        if ($with) {
            $model->with($with);
        }

        if ($field !== '*') {
            $model->field($field);
        }

        return $model->where($where)->get();
    }

    /**
     * @param array  $where
     * @param string $field
     * @param int    $page
     * @param int    $limit
     * @param string $order
     * @param array  $with
     * @return BaseModel
     * @throws \Exception
     */
    public function selectModel(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = [])
    {
        $model = $this->getModel()->where($where);

        if ($page && $limit) {
            $model->page($page, $limit)->withTotalCount();
        }

        if ($order) {
            $model->orders($order);
        }

        if ($with) {
            $model->with($with);
        }

        return $model->field($field);
    }

    /**
     * @param array  $where
     * @param string $field
     * @param int    $page
     * @param int    $limit
     * @param string $order
     * @param array  $with
     * @return array
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function selectList(array $where, string $field = '*', int $page = 0, int $limit = 0, string $order = '', array $with = [])
    {
        $model = $this->selectModel($where, $field, $page, $limit, $order, $with);
        $list = $model->select();
        return ['list' => $list, 'total' => $model->lastQueryResult()->getTotalCount()];
    }

    /**
     * 查询一条数据是否存在
     * @param        $map
     * @param string $field
     * @return bool
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function be($map, string $field = '')
    {
        if (!is_array($map) && empty($field)) $field = $this->getPk();
        $map = !is_array($map) ? [$field => $map] : $map;
        return 0 < $this->getModel()->where($map)->count();
    }

    /**
     * 获取单个字段值
     * @param string|array $where
     * @param string|null $field
     * @return array|bool|\EasySwoole\ORM\AbstractModel|\EasySwoole\ORM\Db\Cursor|\EasySwoole\ORM\Db\CursorInterface|mixed|null
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function value($where, ?string $field = '')
    {
        $pk = $this->getPk();
        return $this->getModel()->where($where)->val($field ?: $pk);
    }

    /**
     * 获取某个字段数组
     * @param array  $where
     * @param string $field
     * @param string $key
     * @return array|null
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function getColumn(array $where, string $field, string $key = '')
    {
        if (!$key) {
            return $this->getModel()->where($where)->column($field);
        }

        $fields = [$field, $key];
        /** @var BaseModel[] $columnList */
        $columnList = $this->getModel()->where($where)->field($fields)->all();
        $result = [];
        foreach ($columnList as $item) {
            $itemArr = $item->toArray(false, false);
            $result[$item[$key]] = $itemArr[$field];
        }

        return $result;
    }

    /**
     * 删除
     * @param int|string|array $id
     * @param string|null $key
     * @return bool|int
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function delete($id, ?string $key = null)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [is_null($key) ? $this->getPk() : $key => $id];
        }
        return $this->getModel()->where($where)->destroy();
    }

    /**
     * 删除记录
     * @param int $id
     * @return bool|int
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function destroy(int $id)
    {
        $where = [$this->getPk() => $id];
        return $this->getModel()->destroy($where);
    }

    /**
     * 更新数据
     * @param int|string|array $id
     * @param array            $data
     * @param string|null      $key
     * @return bool
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function update($id, array $data, ?string $key = null)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [is_null($key) ? $this->getPk() : $key => $id];
        }

        return $this->getModel()->update($data, $where);
    }

    /**
     * 批量更新数据
     * @param array       $ids
     * @param array       $data
     * @param string|null $key
     * @return bool
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function batchUpdate(array $ids, array $data, ?string $key = null)
    {
        $field = is_null($key) ? $this->getPk() : $key;
        $where = [
            $field => [$ids, 'IN'],
        ];

        return $this->getModel()->where($where)->update($data);
    }

    /**
     * 插入数据
     * @param array $data
     * @return bool|int
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function save(array $data)
    {
        return $this->getModel()->data($data)->save();
    }

    /**
     * 插入数据
     * @param array $data
     * @return array
     * @throws \EasySwoole\Mysqli\Exception\Exception
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function saveAll(array $data)
    {
        return $this->getModel()->saveAll($data);
    }

    /**
     * 插入数据
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function saveAllByBuilder(array $data)
    {
        $tableName = $this->getTableName();
        return $this->getModel()->func(function (QueryBuilder $builder) use ($tableName, $data) {
            $builder->insertAll($tableName, $data);
        });
    }

    /**
     * 插入、更新时验证数据
     */
    public  function validateData($data, $type = '')
    {

        return $this->getModel()->validateData($data, $type);
    }
}
