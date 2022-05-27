<?php

namespace Sflightning\Lib\Listener\Swoole;

use Sflightning\Lib\Constante\Lightning;
use Sflightning\Lib\Event\Swoole\LightningFinishEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LightningFinishListener implements EventSubscriberInterface
{

    /**         Methods         **/

    public function onFinish(LightningFinishEvent $event): void
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            Lightning::SWOOLE_FINISH_EVENT => 'onFinish',
        ];
    }
}