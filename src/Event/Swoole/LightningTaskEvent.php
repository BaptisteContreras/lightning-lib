<?php


namespace Sflightning\Lib\Event\Swoole;


use Sflightning\Contracts\Event\Swoole\LightningTaskEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningTaskEvent extends AbstractLightningSwooleEvent implements LightningTaskEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_TASK_EVENT;
    }
}