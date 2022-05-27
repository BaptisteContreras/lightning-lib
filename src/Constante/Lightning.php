<?php

namespace Sflightning\Lib\Constante;

final class Lightning
{

    /**         Properties         **/

    public const SWOOLE_FINISH_EVENT = 'lightning.swoole.finish';
    public const SWOOLE_SERVER_SHUTDOWN_EVENT = 'lightning.swoole.server.shutdown';
    public const SWOOLE_SERVER_START_EVENT = 'lightning.swoole.server.shutdown';
    public const SWOOLE_TASK_EVENT = 'lightning.swoole.task';
    public const SWOOLE_WORKER_START_EVENT = 'lightning.swoole.worker.start';
    public const SWOOLE_WORKER_STOP_EVENT = 'lightning.swoole.worker.stop';

}