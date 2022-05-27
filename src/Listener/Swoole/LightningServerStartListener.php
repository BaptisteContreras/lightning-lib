<?php


namespace Sflightning\Lib\Listener\Swoole;


use Sflightning\Lib\Constante\Lightning;
use Sflightning\Lib\Event\Swoole\LightningServerStartEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LightningServerStartListener implements EventSubscriberInterface
{

    /**         Methods         **/

    public function onServerStart(LightningServerStartEvent $event): void
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            Lightning::SWOOLE_SERVER_START_EVENT => 'onServerStart',
        ];
    }
}