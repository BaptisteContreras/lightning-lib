<?php


namespace Sflightning\Lib\Event\Swoole;


use Sflightning\Contracts\Event\Swoole\LightningServerStartEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningServerStartEvent extends AbstractLightningSwooleEvent implements LightningServerStartEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_SERVER_START_EVENT;
    }
}