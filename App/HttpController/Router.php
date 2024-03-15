<?php


namespace App\HttpController;


use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use FastRoute\RouteCollector;

class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
        //index.php
        $routeCollector->get('/viewReload', '/index/index/viewReload');
        $routeCollector->get('/', '/index/index/index');
        $routeCollector->get('/index', '/index/index/index');

        //首页
        $routeCollector->get('/home', '/index/index/home');

	    //文档
	    $routeCollector->get('/apiDoc/{id:\d+}', '/index/index/api');
	    $routeCollector->get('/apiDoc', '/index/index/api');

        //登录
        $routeCollector->get('/login', '/index/login/login');
        $routeCollector->post('/doLogin', '/index/login/doLogin');
        $routeCollector->post('/getCode', '/index/login/getCode');


        $routeCollector->addRoute(['GET','POST'],'/dayBillAlipayNotify', '/index/bill/alipayNotify');
        $routeCollector->addRoute(['GET','POST'],'/dayBillWechatJsapiPayNotify', '/index/bill/wechatJsapiPayNotify');

    }
}