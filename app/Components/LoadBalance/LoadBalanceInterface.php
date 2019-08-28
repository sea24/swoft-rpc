<?php

namespace App\Components\LoadBalance;
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2019/8/20
 * Time: 11:34 AM
 */
interface  LoadBalanceInterface
{

    //获取全部服务
    public static function getListService(array $serviceList): array;
}