<?php


namespace Sflightning\Lib\Concurrency\Promise;


use Sflightning\Contracts\Concurrency\Coroutine\CoroutinePromiseState;
use Sflightning\Contracts\Concurrency\Promise\LightningPromiseInterface;
use Swoole\Coroutine\WaitGroup;

class PromiseState implements CoroutinePromiseState
{

    /**         Properties         **/

    /** @var LightningPromiseInterface */
    private $promise;

    /** @var WaitGroup */
    private $waitGroup;

    /**         Constructor         **/

    public function __construct(LightningPromiseInterface $promise, WaitGroup $waitGroup)
    {
        $this->promise = $promise;
        $this->waitGroup = $waitGroup;
    }

    /**         Methods         **/
    
    public static function build(LightningPromiseInterface $promise, ?WaitGroup $waitGroup = null): self
    {
        return new self($promise, $waitGroup ?: new WaitGroup());
    }

    /**         Accessors         **/

    public function getPromise(): LightningPromiseInterface
    {
        return $this->promise;
    }

    public function getWaitGroup(): WaitGroup
    {
        return $this->waitGroup;
    }



}