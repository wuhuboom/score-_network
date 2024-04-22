<?php
namespace App\Log;

use EasySwoole\Component\Singleton;
use EasySwoole\Log\LoggerInterface;

class LogHandler implements LoggerInterface
{
    private $logDir;
    use Singleton;//引入单例模式方便调用
    function __construct(string $logDir = null)
    {
        if (empty($logDir)) {
            $logDir = EASYSWOOLE_ROOT;
        }
        $this->logDir = $logDir;
    }

    function log(?string $msg, int $logLevel = self::LOG_LEVEL_INFO, string $category = 'debug'): string
    {
        $date = date('Y-m-d H:i:s');
        $day = date('Ymd');
        $levelStr = $this->levelMap($logLevel);
        if(!is_dir($this->logDir."/Log/{$day}")){
            mkdir($this->logDir."/Log/{$day}");
        }
        $filePath = $this->logDir . "/Log/{$day}/log_{$day}_{$category}.log";
        $str = "[{$date}][{$category}][{$levelStr}] : [{$msg}]\n";
        $res = file_put_contents($filePath, "{$str}", FILE_APPEND | LOCK_EX);
        return $str;
    }

    function console(?string $msg, int $logLevel = self::LOG_LEVEL_INFO, string $category = 'console')
    {
        $date = date('Y-m-d H:i:s');
        $day = date('Ymd');
        $levelStr = $this->levelMap($logLevel);
        if(!is_dir($this->logDir."/Log/{$day}")){
            mkdir($this->logDir."/Log/{$day}");
        }
        $filePath = $this->logDir . "/Log/{$day}/log_{$day}_{$category}.log";
        $temp = "[{$date}][{$category}][{$levelStr}]:[{$msg}]\n";
        $res = file_put_contents($filePath, "{$temp}", FILE_APPEND | LOCK_EX);
        fwrite(STDOUT, $temp);
    }

    private function levelMap(int $level)
    {
        switch ($level) {
            case self::LOG_LEVEL_INFO:
                return 'info';
            case self::LOG_LEVEL_NOTICE:
                return 'notice';
            case self::LOG_LEVEL_WARNING:
                return 'warning';
            case self::LOG_LEVEL_ERROR:
                return 'error';
            default:
                return 'unknown';
        }
    }
}