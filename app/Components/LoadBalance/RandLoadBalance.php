<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2019/8/20
 * Time: 11:42 AM
 */

namespace App\Components\LoadBalance;

use App\Components\LoadBalance\LoadBalanceInterface;


class RandLoadBalance implements LoadBalanceInterface
{
    public static function getListService(array $service): array
    {
        $sum = 0; //总的权重值
        $weightsList = [];
        foreach ($service as $k => $v) {
            $sum += $v['weight'];
            $weightsList[$k]=$sum;
        }
        $rand=mt_rand(0,$sum);
        //var_dump($weightsList,'随机数'.$rand);
        foreach ($weightsList as $k=>$v){
            if($rand<=$v){
                return $service[$k];
            }
        }
    }
}