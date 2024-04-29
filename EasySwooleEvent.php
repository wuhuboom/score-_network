<?php
namespace EasySwoole\EasySwoole;

use App\Crontab\ClearSession;
use App\Crontab\DatabaseBackup;
use App\Crontab\Ended;
use App\Crontab\EndedEvents;
use App\Crontab\ScanUploadFiles;
use App\Crontab\UpcomingEvents;
use App\Languages\Chinese;
use App\Languages\English;
use App\Log\LogHandler;
use EasySwoole\AtomicLimit\AtomicLimit;
use EasySwoole\Component\Di;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\FastCache\Cache;
use EasySwoole\FileWatcher\FileWatcher;
use EasySwoole\FileWatcher\WatchRule;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\I18N\I18N;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\DbManager;
use EasySwoole\Template\Render;
use App\Tools\Session;
use EasySwoole\Session\FileSession;
use EasySwoole\Utility\Random;


class EasySwooleEvent implements Event
{
    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');
        // 注册语言包
        I18N::getInstance()->addLanguage(new Chinese(), 'Cn');
        I18N::getInstance()->addLanguage(new English(), 'En');

        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_GLOBAL_ON_REQUEST, function (Request $request, Response $response) {
            // 获取 header 中 language 参数
            $lang = 'Cn';
            // 设置默认语言包
            I18N::getInstance()->setDefaultLanguage($lang);
            return true;
        });
        // 基于文件存储，传入 EASYSWOOLE_TEMP_DIR . '/Session' 目录作为 session 数据文件存储位置
        Session::getInstance(new FileSession(EASYSWOOLE_TEMP_DIR . '/Session'));

        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_GLOBAL_ON_REQUEST, function (\EasySwoole\Http\Request $request, \EasySwoole\Http\Response $response): bool {
            ###### 处理请求的跨域问题 ######
            $response->withHeader('Access-Control-Allow-Origin', '*');
            $response->withHeader('Access-Control-Allow-Methods', 'GET,POST,OPTIONS');
            $response->withHeader('Access-Control-Allow-Credentials', 'true');
            $response->withHeader('Access-Control-Allow-Headers', '*');//X-Token, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With,Form-type,Referer,Connection,Content-Length,Host,Origin,Authorization,Authori-zation,Accept,Accept-Encoding

            if ($request->getMethod() === 'OPTIONS') {
                $response->withStatus(\EasySwoole\Http\Message\Status::CODE_OK);
                return false;
            }
            $point = \EasySwoole\Tracker\PointContext::getInstance()->createStart('onRequest');
            $point->setStartArg([
                'uri' => $request->getUri()->__toString(),
                'get' => $request->getQueryParams()
            ]);

            // TODO: 注册 HTTP_GLOBAL_ON_REQUEST 回调，相当于原来的 onRequest 事件
            // 获取客户端 Cookie 中 system_session 参数
            $sessionId = $request->getCookieParams('system_session');
            if (!$sessionId) {
                $sessionId = Random::character(32); // 生成 sessionId
                // 设置向客户端响应 Cookie 中 easy_session 参数
                $response->setCookie('system_session', $sessionId);
            }
            // 存储 sessionId 方便调用，也可以通过其它方式存储
            $request->withAttribute('system_session', $sessionId);
            Session::getInstance()->create($sessionId); // 创建并返回该 sessionId 的 context

            return true;
        });
        //AfterRequest 事件
        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_GLOBAL_AFTER_REQUEST, function (\EasySwoole\Http\Request $request, \EasySwoole\Http\Response $response): void {

            if ($request->getMethod() !== 'OPTIONS') {
                // session 数据落地【必不可少这一步】
                Session::getInstance()->close($request->getAttribute('system_session'));

                //链路追踪
                $point = \EasySwoole\Tracker\PointContext::getInstance()->startPoint();
                $point->end();
                $array = \EasySwoole\Tracker\Point::toArray($point);
            }
        });
        \EasySwoole\Component\Di::getInstance()->set(\EasySwoole\EasySwoole\SysConst::HTTP_EXCEPTION_HANDLER, [\App\Tools\ExceptionHandler::class, 'handle']);
        //注册mysql连接池
        $configData = Config::getInstance()->getConf('MYSQL');
        $config = new \EasySwoole\ORM\Db\Config($configData);
        DbManager::getInstance()->addConnection(new Connection($config));
        DbManager::getInstance()->onQuery(function ($res, $builder, $start) {
            $queryTime = 1;
            $start_time =bcsub(microtime(true), $start, 3);
            if ($start_time > $queryTime) {
                $log_contents = date('Y-m-d H:i:s').'：'."SQL慢语句 耗时：{$start_time}s\r\n".$builder->getLastQuery();
                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'sql');
            }
        });

    }

    public static function mainServerCreate(EventRegister $register)
    {
        ###### 配置限流器 ######
        $limit = new AtomicLimit();
        /** 为方便测试，（全局的）限制设置为 10 */
        $limit->setLimitQps(10);
        $limit->attachServer(ServerManager::getInstance()->getSwooleServer());
        Di::getInstance()->set('auto_limiter', $limit);
        // 创建定时任务实例

        $ClearSessionCrontab = \EasySwoole\EasySwoole\Crontab\Crontab::getInstance()->addTask(ClearSession::class);
        $DatabaseBackup = \EasySwoole\EasySwoole\Crontab\Crontab::getInstance()->addTask(DatabaseBackup::class);
        $EndedEvents = \EasySwoole\EasySwoole\Crontab\Crontab::getInstance()->addTask(EndedEvents::class);
        $UpcomingEvents = \EasySwoole\EasySwoole\Crontab\Crontab::getInstance()->addTask(UpcomingEvents::class);
        $Ended = \EasySwoole\EasySwoole\Crontab\Crontab::getInstance()->addTask(Ended::class);


        //热重载
        $watcher = new FileWatcher();
        $rule = new WatchRule(EASYSWOOLE_ROOT . "/App"); // 设置监控规则和监控目录
        $watcher->addRule($rule);
        $watcher->setOnChange(function () {
            Logger::getInstance()->info('file change ,reload!!!');
            ServerManager::getInstance()->getSwooleServer()->reload();
        });
        $watcher->attachServer(ServerManager::getInstance()->getSwooleServer());

        /**
         * ****************   实例化该Render,并注入你的驱动配置    ****************
         */
        Render::getInstance()->getConfig()->setRender(new \App\Tools\Template());
        Render::getInstance()->getConfig()->setTempDir(EASYSWOOLE_TEMP_DIR);
        Render::getInstance()->attachServer(ServerManager::getInstance()->getSwooleServer());

        $config = new \EasySwoole\FastCache\Config();
        $config->setTempDir(EASYSWOOLE_TEMP_DIR);
        Cache::getInstance($config)->attachToServer(ServerManager::getInstance()->getSwooleServer());



         //自动更新比赛数据
         $processConfig = new \EasySwoole\Component\Process\Config([
             'processName' => 'Inplay', // 设置 自定义进程名称
             'processGroup' => 'Football', // 设置 自定义进程组名称
             'enableCoroutine' => true, // 设置 自定义进程自动开启协程
         ]);
         \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\Inplay($processConfig));
//        //自动更新比赛数据
//        $processConfig = new \EasySwoole\Component\Process\Config([
//            'processName' => 'UpcomingEvents', // 设置 自定义进程名称
//            'processGroup' => 'Football', // 设置 自定义进程组名称
//            'enableCoroutine' => true, // 设置 自定义进程自动开启协程
//        ]);
//        \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\UpcomingEvents($processConfig));

	    //自动更新比赛数据
	    $processConfig = new \EasySwoole\Component\Process\Config([
		    'processName' => 'GetTeamLogo', // 设置 自定义进程名称
		    'processGroup' => 'Football', // 设置 自定义进程组名称
		    'enableCoroutine' => true, // 设置 自定义进程自动开启协程
	    ]);
	    \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\GetTeamLogo($processConfig));
	    //自动更新比赛数据
	    $processConfig = new \EasySwoole\Component\Process\Config([
		    'processName' => 'Ended', // 设置 自定义进程名称
		    'processGroup' => 'Football', // 设置 自定义进程组名称
		    'enableCoroutine' => true, // 设置 自定义进程自动开启协程
	    ]);
	    \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\Ended($processConfig));
        //自动更新比赛数据
        $processConfig = new \EasySwoole\Component\Process\Config([
            'processName' => 'View', // 设置 自定义进程名称
            'processGroup' => 'Football', // 设置 自定义进程组名称
            'enableCoroutine' => true, // 设置 自定义进程自动开启协程
        ]);
        \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\View($processConfig));
	    //自动更新赛事赔率
	    $processConfig = new \EasySwoole\Component\Process\Config([
		    'processName' => 'Odds', // 设置 自定义进程名称
		    'processGroup' => 'Football', // 设置 自定义进程组名称
		    'enableCoroutine' => true, // 设置 自定义进程自动开启协程
	    ]);
	    \EasySwoole\Component\Process\Manager::getInstance()->addProcess(new \App\Process\Odds($processConfig));
    }

}