<?php
/**
 * Created by PhpStorm.
 * User: Sixstar-Peter
 * Date: 2019/5/25
 * Time: 22:48
 */

namespace App\Rpc\Client;


use Swoft\Rpc\Client\Contract\ProviderInterface;
use App\Components\LoadBalance\RandLoadBalance;

class Provider implements ProviderInterface
{
    protected $nameSea;

    public function __construct($nameSea)
    {
        $this->nameSea = $nameSea;
    }

    public function getList(): array
    {
        //获取健康服务
        $addr = bean('ConsulProvider')->getListServer($this->nameSea);
        //负载机制（加权随机）
        $resultIp = RandLoadBalance::getListService(array_values($addr));
        var_dump($resultIp['address']);
        return ["47.106.178.79:9800"];
    }
}