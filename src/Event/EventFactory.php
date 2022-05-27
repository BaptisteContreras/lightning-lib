<?php


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

    public function createServerStartEvent(Server $server, $workerId): LightningServerStartEventInterface
    {
        return new LightningServerStartEvent($server, $workerId);
    }

    public function createServerShutdownEvent(Server $server, $workerId): LightningServerShutdownEventInterface
    {
        return new LightningServerShutdownEvent($server, $workerId);
    }

    public function createFinishEvent(Server $server, $workerId): LightningFinishEventInterface
    {
        return new LightningFinishEvent($server, $workerId);
    }

    public function createTaskEvent(Server $server, $workerId): LightningTaskEventInterface
    {
        return new LightningTaskEvent($server, $workerId);
    }

    public function createWorkerStartEvent(Server $server, $workerId): LightningWorkerStartEventInterface
    {
        return new LightningWorkerStartEvent($server, $workerId);
    }

    public function createWorkerStopEvent(Server $server, $workerId): LightningWorkerStopEventInterface
    {
        return new LightningWorkerStopEvent($server, $workerId);
    }
}