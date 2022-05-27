<?php


namespace Sflightning\Lib\Event\Swoole;


use Sflightning\Contracts\Event\Swoole\LightningWorkerStopEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningWorkerStopEvent extends AbstractLightningSwooleEvent implements LightningWorkerStopEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_WORKER_STOP_EVENT;
    }
}