<?php

namespace Sflightning\Lib\Event;

use Sflightning\Contracts\Event\EventFactoryInterface;
use Sflightning\Contracts\Event\Swoole\LightningFinishEventInterface;
use Sflightning\Contracts\Event\Swoole\LightningServerShutdownEventInterface;
use Sflightning\Contracts\Event\Swoole\LightningServerStartEventInterface;
use Sflightning\Contracts\Event\Swoole\LightningTaskEventInterface;
use Sflightning\Contracts\Event\Swoole\LightningWorkerStartEventInterface;
use Sflightning\Contracts\Event\Swoole\LightningWorkerStopEventInterface;
use Sflightning\Lib\Event\Swoole\LightningFinishEvent;
use Sflightning\Lib\Event\Swoole\LightningServerShutdownEvent;
use Sflightning\Lib\Event\Swoole\LightningServerStartEvent;
use Sflightning\Lib\Event\Swoole\LightningTaskEvent;
use Sflightning\Lib\Event\Swoole\LightningWorkerStartEvent;
use Sflightning\Lib\Event\Swoole\LightningWorkerStopEvent;
use Swoole\Http\Server;

class EventFactory implements EventFactoryInterface
{
    /**         Methods         **/

    public function createServerStartEvent(Server $server): LightningServerStartEventInterface
    {
        return new LightningServerStartEvent($server);
    }

    public function createServerShutdownEvent(Server $server): LightningServerShutdownEventInterface
    {
        return new LightningServerShutdownEvent($server);
    }

    public function createFinishEvent(Server $server): LightningFinishEventInterface
    {
        return new LightningFinishEvent($server);
    }

    public function createTaskEvent(Server $server): LightningTaskEventInterface
    {
        return new LightningTaskEvent($server);
    }

    public function createWorkerStartEvent(Server $server): LightningWorkerStartEventInterface
    {
        return new LightningWorkerStartEvent($server);
    }

    public function createWorkerStopEvent(Server $server): LightningWorkerStopEventInterface
    {
        return new LightningWorkerStopEvent($server);
    }
}