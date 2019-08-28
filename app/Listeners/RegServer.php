<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2019/8/9
 * Time: 10:51 AM
 */

namespace App\Listeners;

use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Server\ServerEvent;


/**
 * Class RegServer
 * @package App\Listeners
 * @Listener(ServerEvent::BEFORE_START)
 */
class RegServer implements EventHandlerInterface
{

    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        bean('ConsulProvider')->register();
    }
}