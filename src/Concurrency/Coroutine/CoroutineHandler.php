<?php

namespace Sflightning\Lib\Concurrency\Coroutine;

use Sflightning\Contracts\Concurrency\ConcurrencyHandlerInterface;
use Swoole\Coroutine;

class CoroutineHandler implements ConcurrencyHandlerInterface
{

    /**         Methods         **/

    public function handleOne(callable $asyncCallable, ...$args): void
    {
        Coroutine::create($asyncCallable, $args);
    }

    public function handleMultiple(array $asyncCallables): void
    {
       foreach ($asyncCallables as $asyncCallable) {
           Coroutine::create($asyncCallable[0], ...$asyncCallable[1]);
       }
    }
}