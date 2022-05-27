<?php


namespace Sflightning\Lib\Event\Swoole;


use Sflightning\Contracts\Event\Swoole\LightningWorkerStartEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningWorkerStartEvent extends AbstractLightningSwooleEvent implements LightningWorkerStartEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_WORKER_START_EVENT;
    }
}