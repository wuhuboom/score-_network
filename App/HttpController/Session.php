<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Session\Context;

class Session extends Controller
{
    protected function session(): ?Context
    {
        // 封装一个方法，方便我们快速获取 session context
        $sessionId = $this->request()->getAttribute('system_session');
        return \App\Tools\Session::getInstance()->create($sessionId);
    }

    // 将值保存在 session 中
    public function set()
    {
        // $this->session()->set('key', 'value');
        // 把 'test_session_key' 作为键，time() 的值作为值，保存在 session 中
        $this->session()->set('system_session', time());
        // 响应客户端
        $this->writeJson(200, 'success!');
    }

    // 获取 session 中的值
    public function get()
    {
        // $this->session()->get('key');
        // 从 session 中获取 key 为 'test_session_key' 的值
        $ret = $this->session()->get('system_session');

        // 响应客户端
        $this->writeJson(200, $ret);
    }

    // 获取 session 中所有数据
    public function all()
    {
        // 获取 session 中所有数据
        $ret = $this->session()->allContext();

        // 响应客户端
        $this->writeJson(200, $ret);
    }

    // 删除 session 中的值
    public function del()
    {
        // $this->session()->del('key');
        // 删除 session 中 key 为 'test_session_key' 的值
        $this->session()->del('system_session');

        // 再次获取 session 中所有数据并响应客户端
        $this->writeJson(200, $this->session()->allContext());
    }

    // 清空 session 中所有数据
    public function flush()
    {
        // 清空 session 中所有数据
        $this->session()->flush();

        // 再次获取 session 中所有数据并响应客户端
        $this->writeJson(200, $this->session()->allContext());
    }

    // 重新设置(覆盖) session 中的数据
    public function setData()
    {
        // 重新设置(覆盖) session 中的数据
        $ret = $this->session()->setData([
            'system_session_key' => 1,
            'system_session_key1' => 2
        ]);

        // 再次获取 session 中所有数据并响应给客户端
        $this->writeJson(200, $ret->allContext());
    }
}