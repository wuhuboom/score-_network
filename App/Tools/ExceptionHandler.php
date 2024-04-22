<?php

namespace App\Tools;

use App\Log\LogHandler;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

class ExceptionHandler
{
    public static function handle(\Throwable $exception, Request $request, Response $response)
    {
        LogHandler::getInstance()->log($exception->getMessage().PHP_EOL.$exception->getTraceAsString(),LogHandler::getInstance()::LOG_LEVEL_INFO,'error');
    }
}