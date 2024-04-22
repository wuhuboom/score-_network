<?php
declare(strict_types=1);
namespace App\Service;

abstract class BaseService
{
    /**
     * @var $dao
     */
    protected $dao;

    public function setDao($dao){
        $this->dao = $dao;
    }

    /**
     * 魔术方法，访问不存在方法或没有权限方法时自动调用
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->dao, $name], $arguments);
    }

    /**
     * 自动实例化服务
     * @return static
     */
    public static function create():BaseService
    {
        $di = \EasySwoole\Component\Di::getInstance();
        $className = get_called_class();
        $obj = $di->get($className);
        if(!$obj){
            $reflect = new \ReflectionClass($className);
            if($reflect->getConstructor()->getParameters()){
                foreach ($reflect->getConstructor()->getParameters() as $parameter) { // 遍历所有参数
                    $daoName = $parameter->getType()->getName();
                }
                $di->set($className,$className,new $daoName);
            }else{
                $di->set($className,$className);
            }

            $obj = $di->get($className);
        }
        return $obj;
        //return new static(new $daoName);
    }

   /**
    * 验证数据
    */
    public function validateData($data,$type){
        return $this->dao->validateData($data,$type);
    }
}
