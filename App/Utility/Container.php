<?php
namespace App\Utility;

class Container {
    private $services = []; // 存放已经实例化的服务对象

    public function bind($abstract, $concrete) {
        if (is_string($concrete)) {
            $this->bindClass($abstract, $concrete);
        } elseif ($concrete instanceof Closure) {
            $this->bindClosure($abstract, $concrete);
        } else {
            throw new Exception('Invalid concrete type');
        }

        return $this;
    }

    protected function bindClass($abstract, $concrete) {
        $this->services[$abstract] = function () use ($concrete) {
            return new $concrete();
        };
    }

    protected function bindClosure($abstract, Closure $closure) {
        $this->services[$abstract] = $closure;
    }

    public function make($abstract) {
        if (!isset($this->services[$abstract])) {
            throw new Exception("No binding for {$abstract}");
        }

        return call_user_func($this->services[$abstract]);
    }
}