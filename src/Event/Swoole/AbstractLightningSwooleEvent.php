<?php


namespace Sflightning\Lib\Event\Swoole;


use Swoole\Http\Server;

abstract class AbstractLightningSwooleEvent
{

    /**         Properties         **/

    /** @var Server */
    protected $server;

    protected $workerId;

    /**         Constructor         **/

    public function __construct(Server $server, $workerId)
    {
        $this->server = $server;
        $this->workerId = $workerId;
    }

    /**         Accessors         **/

    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @return mixed
     */
    public function getWorkerId()
    {
        return $this->workerId;
    }

}