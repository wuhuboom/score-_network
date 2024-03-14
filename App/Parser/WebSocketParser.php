<?php

namespace App\Parser;

use EasySwoole\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Socket\Bean\Caller;
use EasySwoole\Socket\Bean\Response;

class WebSocketParser implements ParserInterface
{
    public function decode($raw, $client): ?Caller
    {

        $data = json_decode($raw, true);
        $data['fd']=$client->getFd();
        $caller = new Caller();
        $controller = !empty($data['controller']) ? $data['controller'] : 'Index';
        $action = !empty($data['type']) ? $data['type'] : 'index';
        $param = !empty($data) ? $data : [];

        $controller = "App\\WebSocketController\\{$controller}";
        $caller->setControllerClass($controller);
        $caller->setAction($action);
        $caller->setArgs($param);
        return $caller;
    }

    public function encode(Response $response, $client): ?string
    {
        return json_encode($response->getMessage());
    }
}