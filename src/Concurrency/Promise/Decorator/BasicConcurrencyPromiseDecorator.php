<?php

namespace Sflightning\Lib\Concurrency\Promise\Decorator;



use Sflightning\Contracts\Concurrency\Coroutine\CoroutinePromiseState;
use Sflightning\Contracts\Concurrency\Promise\ConcurrencyPromiseDecoratorInterface;
use Sflightning\Contracts\Concurrency\Promise\PromiseStateInterface;
use Sflightning\Lib\Concurrency\Promise\Exception\InvalidPromiseStateException;

class BasicConcurrencyPromiseDecorator implements ConcurrencyPromiseDecoratorInterface
{
    /**         Methods         **/

    public function decorateTaskCallback(PromiseStateInterface $promiseState): callable
    {
        if (!$promiseState instanceof CoroutinePromiseState) {
            throw new InvalidPromiseStateException(self::class, $promiseState);
        }

        $promise = $promiseState->getPromise();
        $waitGroup = $promiseState->getWaitGroup();

        return function (array $args) use ($promise, $waitGroup) {
            $waitGroup->add();
            $promise->getTask()($args[0], $args[1]);
        };
    }

    public function decorateResolveCallback(PromiseStateInterface $promiseState): callable
    {
        if (!$promiseState instanceof CoroutinePromiseState) {
            throw new InvalidPromiseStateException(self::class, $promiseState);
        }
        $promise = $promiseState->getPromise();
        $waitGroup = $promiseState->getWaitGroup();

        return function ($result = null) use ($promise, $waitGroup) {
            $waitGroup->done();
            $promise->getResolveCallback()($result);
            $promise->getFinallyCallback()($result);
        };

    }

    public function decorateRejectCallback(PromiseStateInterface $promiseState): callable
    {
        if (!$promiseState instanceof CoroutinePromiseState) {
            throw new InvalidPromiseStateException(self::class, $promiseState);
        }

        $promise = $promiseState->getPromise();
        $waitGroup = $promiseState->getWaitGroup();

        return function ($result = null) use ($promise, $waitGroup) {
            $waitGroup->done();
            $promise->getCatchCallback()($result);
            $promise->getFinallyCallback()($result);
        };
    }
}