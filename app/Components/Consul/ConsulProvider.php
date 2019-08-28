<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2019/8/9
 * Time: 5:39 PM
 */

namespace App\Components\Consul;


class ConsulProvider
{

    const REGISTER_PATH = '/v1/agent/service/register'; //服务注册路径
    const HEALTH_PATH = '/v1/health/service/'; //获取健康服务

    public function register()
    {
        //注册服务
        $config = bean('config')->get('provider.consul');
        $url = 'http://' . $config['address'] . ':' . $config['port'] . ConsulProvider::REGISTER_PATH;
        $this->curlRequest($url, "PUT", json_encode($config['register']));
    }


    /**
     * 获取健康服务
     */
    public function getListServer($nameSea)
    {
        $config = bean('config')->get('provider.consul');
        $query = [
            'dc' => 'dc1'
        ];
        if (!empty($config['discovery']['tag'])) {
            $query['tag'] = 'primary';
        }
        $queryStr = http_build_query($query);
        //排除不健康的服务,获取健康服务
        $url = 'http://' . $config['address'] . ':' . $config['port'] . self::HEALTH_PATH . $nameSea . '?' . $queryStr;
        $serviceList = $this->curlRequest($url, 'GET');
        $serviceList = json_decode($serviceList, true);
        $address = [];
        foreach ($serviceList as $k => $v) {
            //判断当前的服务是否是活跃的,并且是当前想要去查询服务
            foreach ($v['Checks'] as $c) {
                if ($c['ServiceName'] == $nameSea && $c['Status'] == "passing") {
                    $address[$k]['address'] = $v['Service']['Address'] . ":" . $v['Service']['Port'];
                    $address[$k]['weight'] = $v['Service']['Weights']['Passing'];
                }
            }
        }
        return $address;
    }

    /**
     * @param $url
     * @param string $method
     * @param array $data
     * @return mixed
     */
    public function curlRequest($url, $method = 'POST', $data = [])
    {
        $method = strtoupper($method);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}