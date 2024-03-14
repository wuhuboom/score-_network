<?php

use EasySwoole\Log\LoggerInterface;

return [
    'SERVER_NAME' => "EasySwoole",
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => EASYSWOOLE_WEB_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER
        'SOCK_TYPE' => SWOOLE_TCP,
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'worker_num' => 4,
            'reload_async' => true,
            'max_wait_time' => 3,
            'package_max_length' => 104857600, //文件上传最大限制100MB
            'socket_buffer_size' => 128 * 1024 *1024, //必须为数字，单位为字节，如128 * 1024 *1024表示每个TCP客户端连接最大允许有128M待发送的数据
            'buffer_output_size' => 128 * 1024 * 1024, //必须为数字
//            'document_root' => '/www/wwwroot/s/', // v4.4.0以下版本, 此处必须为绝对路径
//            'enable_static_handler' => true,
        ],
        'TASK' => [
            'workerNum' => 4,
            'maxRunningNum' => 128,
            'timeout' => 15
        ]
    ],
    "LOG" => [
        'dir' => null,
        'level' => LoggerInterface::LOG_LEVEL_DEBUG,
        'handler' =>  new \App\Log\LogHandler(),
        'logConsole' => true,
        'displayConsole'=>true,
        'ignoreCategory' => ['debug', 'notice']
    ],
    'TEMP_DIR' => null,
    'PSW_STR'=>'potato', //密码加密字符串
    'MYSQL'         => [
        //数据库配置
        'host'                 => '127.0.0.1',//数据库连接ip
        'user'                 => 'system',//数据库用户名
        'password'             => 'TfxAkCndsXWWGcCX',//数据库密码
        'database'             => 'system',//数据库
        'port'                 => '3306',//端口
        'timeout'              => '30',//超时时间
        'connect_timeout'      => '5',//连接超时时间
        'charset'              => 'utf8mb4',//字符编码
        'strict_type'          => false, //开启严格模式，返回的字段将自动转为数字类型
        'fetch_mode'           => false,//开启fetch模式, 可与pdo一样使用fetch/fetchAll逐行或获取全部结果集(4.0版本以上)
        'alias'                => '',//子查询别名
        'isSubQuery'           => false,//是否为子查询
        'max_reconnect_times ' => '3',//最大重连次数
        //连接池配置
        'intervalCheckTime'    => 30 * 1000,//定时验证对象是否可用以及保持最小连接的间隔时间
        'maxIdleTime'          => 15,//最大存活时间,超出则会每$intervalCheckTime/1000秒被释放
        'maxObjectNum'         => 50,//最大创建数量
        'minObjectNum'         => 5,//最小创建数量 最小创建数量不能大于等于最大创建数量,否则报错 每$intervalCheckTime/1000秒去判断最小连接数
        'getObjectTimeout'     => 3.0,//连接池对象获取连接对象时的等待时间
    ],
    /**##################     JWT 配置     #############*/
    'JWT' => [
        'iss' => 'potato', // 发行人
        'exp' => 604800, // 过期时间 默认2天 7*24*60*60=172800
        'sub' => 'potato', // 主题
        'nbf' => NULL, // 在此之前不可用
        'key' => 'potato', // 签名用的key
    ],
    'Redis' => [
        'host'      => '127.0.0.1',
        'port'      => '6379',
        'auth'      => '',
        'db'        => null,
    ],
];
