<?php

namespace Sflightning\Lib\Concurrency\Promise;

use Sflightning\Contracts\Concurrency\Promise\LightningPromiseInterface;
use Sflightning\Contracts\Constante\Concurrency;

class Promise implements LightningPromiseInterface
{

    /**         Properties         **/

    /** @var Callable */
    private $task;

    /** @var ?Callable */
    private $resolveCallback;

    /** @var ?Callable */
    private $catchCallback;

    /** @var ?Callable */
    private $finallyCallback;

    private $result;

    /** @var int */
    private $state;

    /** @var string */
    private $uid;


    /**         Constructor         **/

    public function __construct(callable $task)
    {
        $this->task = $task;
        $this->state = Concurrency::PROMISE_STATE_PENDING;
        $this->uid = PromiseTools::generateUid();

        $this->then(function () {});
        $this->catch(function () {});
        $this->finally(function () {});
    }

    /**         Methods         **/

    public static function buildFromCallable(callable $task): LightningPromiseInterface
    {
        return new self($task);
    }

    /**         Accessors         **/

    public function getTask(): callable
    {
        return $this->task;
    }

    public function getResolveCallback(): callable
    {
        return $this->resolveCallback;
    }

    public function getCatchCallback(): callable
    {
        return $this->catchCallback;
    }

    public function getFinallyCallback(): callable
    {
        return $this->finallyCallback;
    }

    public function then(callable $resolveCallback): LightningPromiseInterface
    {
        $this->resolveCallback = $this->decorateResolveFunction($resolveCallback);

        return $this;
    }

    public function catch(callable $catchCallback): LightningPromiseInterface
    {
        $this->catchCallback = $this->decorateCatchFunction($catchCallback);

        return $this;
    }

    public function finally(callable $finallyCallback): LightningPromiseInterface
    {
        $this->finallyCallback = $finallyCallback;

        return $this;
    }

    private function decorateResolveFunction(callable $resolveFunction): callable
    {
        return function ($result = null) use ($resolveFunction) {
            $this->state = Concurrency::PROMISE_STATE_FINISHED;

            return $resolveFunction($result);
        };
    }

    private function decorateCatchFunction(callable $catchFunction): callable
    {
        return function ($result = null) use ($catchFunction) {
            $this->state = Concurrency::PROMISE_STATE_ERROR;

            return $catchFunction($result);
        };
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function isFinish(): bool
    {
        return Concurrency::PROMISE_STATE_PENDING !== $this->state;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result): LightningPromiseInterface
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }
}