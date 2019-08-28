<?php
/**
 * Created by PhpStorm.
 * User: Sixstar-Peter
 * Date: 2019/5/25
 * Time: 22:45
 */

namespace App\Rpc\Client;

use Swoft\Rpc\Client\Contract\ProviderInterface;

class Client extends \Swoft\Rpc\Client\Client
{
    protected $nameSea;

    public function getProvider(): ?ProviderInterface
    {

        return $this->provider = new Provider($this->nameSea);
    }

    public function nameSea()
    {
        return $this->nameSea();
    }
}