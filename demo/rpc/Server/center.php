<?php
/**
 * Created by PhpStorm.
 * User: Sixstar-Peter
 * Date: 2019/5/22
 * Time: 22:20
 */

$server=new Swoole\Server('0.0.0.0',9508);
$server->set([
    'worker_num'=>1, //设置进程
    //'heartbeat_idle_time'=>10,//连接最大的空闲时间
    //'heartbeat_check_interval'=>3 //服务器定时检查
    'open_length_check'=>1,
    'package_length_type'=>'N',//设置包头的长度
    'package_length_offset'=>0, //包长度从哪里开始计算
    'package_body_offset'=>4,  //包体从第几个字节开始计算
]);

$server->on('receive',function (swoole_server $server, int $fd, int $reactor_id, string $data){
       //遵循规则,就可以调用到服务
       $info=unpack('N',$data);
       $data=substr($data,-$info[1]);
       $data=json_decode($data,true); //调用
       $serviceName=$data['serviceName'];
       $method=$data['method'];
       var_dump($serviceName,$method);
       //加载文件返回数据(作业)

       //include  "";
       $server->send($fd,"123456");
});

$server->start();