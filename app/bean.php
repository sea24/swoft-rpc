<?php

use Swoft\Http\Server\HttpServer;
use Swoft\Task\Swoole\TaskListener;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Rpc\Client\Client as ServiceClient;
use Swoft\Rpc\Client\Pool as ServicePool;
use Swoft\Rpc\Server\ServiceServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\WebSocket\Server\WebSocketServer;
use Swoft\Server\Swoole\SwooleEvent;
use Swoft\Db\Database;
use Swoft\Redis\RedisDb;

return [
    'logger' => [
        'flushRequest' => true,
        'enable' => false,
        'json' => false,
    ],
    'httpServer' => [
        'class' => HttpServer::class,
        'port' => 9090,
        'listener' => [
            'rpc' => \bean('rpcServer')
        ],
        'on' => [
            SwooleEvent::TASK => \bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => \bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting' => [
            'task_worker_num' => 12,
            'task_enable_coroutine' => true
        ]
    ],
    'db' => [
        'class' => Database::class,
        'dsn' => 'mysql:dbname=test;host=172.17.0.1',
        'username' => 'root',
        'password' => 'swoft123456',
    ],
    'redis' => [
        'class' => RedisDb::class,
        'host' => '127.0.0.2',
        'port' => 6379,
        'database' => 0,
    ],
    'client' => [
        'class' => App\Rpc\Client\Client::class,
        'host' => '127.0.0.2',
        'port' => 9800,
        'nameSea' => 'client',
        'setting' => [
            'timeout' => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout' => 10.0,
            'read_timeout' => 0.5,
        ],
        'packet' => \bean('rpcClientPacket')
    ],
    'live' => [
        'class' => ServiceClient::class,
        'host' => '118.24.109.254',
        'port' => 9509,
        'setting' => [
            'timeout' => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout' => 10.0,
            'read_timeout' => 0.5,
        ],
        'packet' => \bean('rpcClientPacket')
    ],
    'pay' => [
        'class' => App\Rpc\Client\Client::class,
        'host' => '127.0.0.2',
        'port' => 9800,
        'nameSea' => 'test-sea',
        'setting' => [
            'timeout' => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout' => 10.0,
            'read_timeout' => 0.5,
        ],
        'packet' => \bean('rpcClientPacket')
    ],
    //连接池
    'user.pool' => [
        'class' => ServicePool::class,
        'client' => \bean('client')
    ],
    'pay.pool' => [
        'class' => ServicePool::class,
        'client' => \bean('pay')
    ],
    'rpcServer' => [
        'class' => ServiceServer::class,
        'port' => 9800

    ],
    'wsServer' => [
        'class' => WebSocketServer::class,
        'on' => [
            // Enable http handle
            SwooleEvent::REQUEST => \bean(RequestListener::class),
        ],
        'debug' => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'log_file' => alias('@runtime/swoole.log'),
        ],
    ],

    'ConsulProvider' => [
        'class' => App\Components\Consul\ConsulProvider::class,
    ],
];
