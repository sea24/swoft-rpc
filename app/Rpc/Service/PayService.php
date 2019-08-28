<?php declare(strict_types=1);


namespace App\Rpc\Service;


use App\Rpc\Lib\PayInterface;
use App\Rpc\Lib\UserInterface;
use Swoft\Co;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class UserService
 *
 * @since 2.0
 *
 * @Service()
 */
class PayService implements PayInterface
{
    /**
     * @param int   $id
     * @param mixed $type
     * @param int   $count
     *
     * @return array
     */
    public function pay(): array
    {
        return ['result' => ['ok' . rand(100,999)]];
    }

}