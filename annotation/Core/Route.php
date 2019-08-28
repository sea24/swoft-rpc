<?php
/**
 * Created by PhpStorm.
 * User: Sixstar-Peter
 * Date: 2019/5/17
 * Time: 21:24
 */

namespace Core;
use Annotation\Mapping\Bean;

/**
 * Class Route
 * @Bean("route")
 */
class Route
{
    /*
     * object=object
       action=index
     * prefix=test
     * path=abc
     * */
    protected static $Routes;

    public static function addRoute($prefix,$path,$handler,$action)
    {
        self::$Routes[]=['uri'=>$prefix.$path,'handler'=>$handler,'action'=>$action];
    }

    public static function dispatch($uri)
    {
        foreach (self::$Routes as $path){
                if($path['uri']===$uri){
                    //调用控制器
                    $action=$path['action'];
                    $path['handler']->$action();
                }

        }
        return '';
    }

    public static  function  all(){
          return self::$Routes;
    }
}