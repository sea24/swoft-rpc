<?php
/**
 * Created by PhpStorm.
 * User: Sixstar-Peter
 * Date: 2019/5/15
 * Time: 21:46
 */
$loader = require __DIR__ . "/vendor/autoload.php";


//初始化自动加载并解析注解类
Core\Application::init();


$server=new  Swoole\Http\Server('0.0.0.0',9501);
$server->on('request',function ($request,$response){

     var_dump(Core\Application::getBean('route'));
    //var_dump(\Core\Route::dispatch($request->server['path_info']));
});

$server->start();