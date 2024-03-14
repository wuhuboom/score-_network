<?php

namespace EasySwoole\WeChat\OfficialAccount\Draft;

use EasySwoole\WeChat\OfficialAccount\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app[Application::Draft] = function ($app) {
            return new Client($app);
        };
    }
}