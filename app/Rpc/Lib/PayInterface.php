<?php declare(strict_types=1);


namespace App\Rpc\Lib;

/**
 * Class UserInterface
 *
 * @since 2.0
 */
interface PayInterface
{
    /**
     * @return array
     */
    public function pay(): array;

}