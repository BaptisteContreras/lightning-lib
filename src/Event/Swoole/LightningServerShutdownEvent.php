<?php


namespace Sflightning\Lib\Event\Swoole;


use Sflightning\Contracts\Event\Swoole\LightningServerShutdownEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningServerShutdownEvent extends AbstractLightningSwooleEvent implements LightningServerShutdownEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_SERVER_SHUTDOWN_EVENT;
    }
}