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
        $routeCollector->post('/uploadPicture', '/index/common/uploadPicture');

        //文档
        $routeCollector->get('/apiDoc/{id:\d+}', '/index/index/api');
        $routeCollector->get('/apiDoc', '/index/index/api');

        //首页
        $routeCollector->get('/home', '/index/index/home');

        //产品
        $routeCollector->get('/product_details/{id:\d+}', '/index/product/details');
        $routeCollector->get('/orders', '/index/product/orders');
        $routeCollector->get('/orders/{id:\d+}', '/index/product/orderDetails');
        $routeCollector->get('/getOrders', '/index/api/getOrders');
        $routeCollector->addRoute(['POST'],'/product_buy', '/index/product/buy');

        //登录
        $routeCollector->get('/logout', '/index/login/logout');
        $routeCollector->get('/login', '/index/login/login');
        $routeCollector->post('/doLogin', '/index/login/doLogin');
        $routeCollector->post('/getCode', '/index/login/getCode');
        $routeCollector->post('/sendSms', '/index/login/sendSms');
        $routeCollector->addRoute(['GET','POST'],'/register', '/index/login/register');
        $routeCollector->addRoute(['GET','POST'],'/forget', '/index/login/forget');

        //用户
        $routeCollector->get('/vip', '/index/user/vip');
        $routeCollector->get('/my', '/index/user/my');
        $routeCollector->get('/mail', '/index/user/mail');
        $routeCollector->get('/about', '/index/index/about');
        $routeCollector->post('/getHandleCode', '/index/user/getHandleCode');
        $routeCollector->addRoute(['GET','POST'],'/info', '/index/user/info');
        $routeCollector->addRoute(['GET','POST'],'/password', '/index/user/password');
        $routeCollector->addRoute(['GET','POST'],'/tradePassword', '/index/user/tradePassword');
        $routeCollector->addRoute(['GET','POST'],'/withdraw', '/index/user/withdraw');
        $routeCollector->addRoute(['GET','POST'],'/recharge', '/index/user/recharge');
        $routeCollector->addRoute(['GET','POST'],'/rechargeNotify', '/index/user/rechargeNotify');
        $routeCollector->addRoute(['GET','POST'],'/withdrawNotify', '/index/user/withdrawNotify');
        $routeCollector->addRoute(['GET','POST'],'/withdrawalNotify', '/index/user/withdrawNotify');
        $routeCollector->get('/bankCardInfo/{id:\d+}', '/index/user/bankCardInfo');
        $routeCollector->get('/bankCardInfo', '/index/user/bankCardInfo');
        $routeCollector->post('/bankCardInfo', '/index/user/bankCardInfo');
        $routeCollector->get('/balanceDetails', '/index/user/balance_details');
        $routeCollector->addRoute(['GET','POST'],'/getBalanceDetails', '/index/api/getBalanceDetails');

        //博客
        $routeCollector->get('/blog', '/index/blog/index');
        $routeCollector->get('/getBlog', '/index/api/getBlog');
        $routeCollector->addRoute(['GET','POST'],'/postBlog', '/index/blog/post');
	    //任务
	    $routeCollector->get('/tasks', '/index/tasks/index');
	    //邀请
	    $routeCollector->get('/invitation', '/index/invitation/index');


        $routeCollector->addRoute(['GET','POST'],'/dayBillAlipayNotify', '/index/bill/alipayNotify');
        $routeCollector->addRoute(['GET','POST'],'/dayBillWechatJsapiPayNotify', '/index/bill/wechatJsapiPayNotify');

    }
}