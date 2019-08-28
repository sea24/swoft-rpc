<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Rpc\Lib\PayInterface;
use App\Rpc\Lib\UserInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * Class RpcController
 *
 * @since 2.0
 *
 * @Controller()
 */
class RpcController
{
    /**
     * 属性注解,引入user服务,启动rpc客户端
     * @Reference(pool="user.pool")
     * @var UserInterface
     */
    private $userService;

    /**
     * @Reference(pool="user.pool", version="1.2")
     *
     * @var UserInterface
     */
    private $userService2;

    /**
     * @Reference(pool="pay.pool")
     * @var  PayInterface
     */
    private $payService;

    /**
     * @RequestMapping("getList")
     *
     * @return array
     */
    public function getList(): array
    {
        //swoft还没有实现远程调用（封装）
        $result = $this->userService->getList(12, 'type');
        $result2 = $this->userService2->getList(12, 'type');
        $result3 = $this->payService->pay();
        return [$result, $result2, $result3];
    }

    /**
     * @RequestMapping("pay")
     *
     * @return array
     */
    public function pay(): array
    {
        $result3 = $this->payService->pay();
        return [$result3];
    }

    /**
     * @RequestMapping("returnBool")
     *
     * @return array
     */
    public function returnBool(): array
    {
        $result = $this->userService->delete(12);

        if (is_bool($result)) {
            return ['bool'];
        }

        return ['notBool'];
    }

    /**
     * @RequestMapping()
     *
     * @return array
     */
    public function bigString(): array
    {
        $string = $this->userService->getBigContent();

        return ['string'];
    }
}