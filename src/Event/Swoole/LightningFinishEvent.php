<?php

namespace Sflightning\Lib\Event\Swoole;

use Sflightning\Contracts\Event\Swoole\LightningFinishEventInterface;
use Sflightning\Lib\Constante\Lightning;

class LightningFinishEvent extends AbstractLightningSwooleEvent implements LightningFinishEventInterface
{
    /**         Methods         **/

    public function getName(): string
    {
        return Lightning::SWOOLE_FINISH_EVENT;
    }
}