<?php


namespace Sflightning\Lib\Event\Swoole;


use Swoole\Http\Server;

abstract class AbstractLightningSwooleEvent
{

    /**         Properties         **/

    /** @var Server */
    protected $server;

    /**         Constructor         **/

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**         Accessors         **/

    public function getServer(): Server
    {
        return $this->server;
    }

}