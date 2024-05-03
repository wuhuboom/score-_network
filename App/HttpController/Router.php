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

        $routeCollector->get('/league/{id:\d+}', '/index/league/index');
        $routeCollector->get('/competition/{event_id:\d+}', '/index/index/competition');
        $routeCollector->get('/soccer', '/index/index/soccer');
        $routeCollector->get('/soccer/inplay', '/index/soccer/inplay');
        $routeCollector->get('/soccer/data', '/index/index/soccerData');
        $routeCollector->get('/fixtures', '/index/index/fixtures');
        $routeCollector->get('/results', '/index/index/results');
        $routeCollector->get('/search', '/index/index/search');
        $routeCollector->get('/team/{id:\d+}', '/index/team/index');
        $routeCollector->get('/player/{id:\d+}', '/index/team/player');
        //$routeCollector->get('/league/{id:\d+}', '/index/league/index');

        //API
        $routeCollector->get('/apiDoc/{id:\d+}', '/index/index/api');
        $routeCollector->get('/apiDoc', '/index/index/api');
        $routeCollector->get('/getInplay', '/index/api/getInplay');
        $routeCollector->get('/getLeague', '/index/api/getLeague');
        $routeCollector->get('/getUpcoming', '/index/api/getUpcoming');
        $routeCollector->get('/getEnded', '/index/api/getEnded');
        $routeCollector->get('/getLeagueTable', '/index/api/getLeagueTable');
        $routeCollector->get('/getTeamSquad', '/index/api/getTeamSquad');
        $routeCollector->addRoute(['GET','POST'],'/getStatsTrend', '/index/api/getStatsTrend');


        //首页
        $routeCollector->get('/home', '/index/index/home');
        //产品
        $routeCollector->get('/product_details/{id:\d+}', '/index/product/details');
        $routeCollector->addRoute(['POST'],'/product_buy', '/index/product/buy');

        //登录
        $routeCollector->get('/login', '/index/login/login');
        $routeCollector->post('/doLogin', '/index/login/doLogin');
        $routeCollector->post('/getCode', '/index/login/getCode');


        $routeCollector->addRoute(['GET','POST'],'/dayBillAlipayNotify', '/index/bill/alipayNotify');
        $routeCollector->addRoute(['GET','POST'],'/dayBillWechatJsapiPayNotify', '/index/bill/wechatJsapiPayNotify');

    }
}