<?php


namespace Sflightning\Lib\Concurrency\Promise;


use Sflightning\Contracts\Concurrency\ConcurrencyHandlerInterface;
use Sflightning\Contracts\Concurrency\ConcurrencyManagerInterface;
use Sflightning\Contracts\Concurrency\Promise\ConcurrencyPromiseDecoratorInterface;
use Sflightning\Contracts\Concurrency\Promise\LightningPromiseInterface;
use Sflightning\Contracts\Concurrency\Promise\PromiseStateInterface;
use Sflightning\Contracts\Constante\Concurrency;
use Sflightning\Lib\Concurrency\Promise\Decorator\BasicConcurrencyPromiseDecorator;
use Sflightning\Lib\Concurrency\Promise\Exception\InvalidPromiseTypeException;
use Sflightning\Lib\Concurrency\Promise\Exception\PromiseAlreadyHandledException;
use Sflightning\Lib\Concurrency\Promise\Exception\PromiseNotHandledException;

class ConcurrencyPromiseManager implements ConcurrencyManagerInterface
{

    /**         Properties         **/

    /** @var ConcurrencyHandlerInterface */
    private $coroutineHandler;

    /** @var BasicConcurrencyPromiseDecorator */
    private $promiseDecorator;

    /** @var array<string, PromiseState> */
    private $promisesSet;

    /**         Constructor         **/

    public function __construct(ConcurrencyHandlerInterface $coroutineHandler, ConcurrencyPromiseDecoratorInterface $basicConcurrencyPromiseDecorator)
    {
        $this->coroutineHandler = $coroutineHandler;
        $this->promiseDecorator = $basicConcurrencyPromiseDecorator;
        $this->promisesSet = [];
    }

    /**         Methods         **/

    public function executePromises(...$promises): void
    {
        $asyncTask = array_map(function ($promise)  {
            if (!$promise instanceof LightningPromiseInterface) {
                throw new InvalidPromiseTypeException($promise);
            }

            if ($this->checkExistsInSet($promise)) {
                throw new PromiseAlreadyHandledException($promise->getUid());
            }

            $promiseState = $this->createPromiseState($promise);

            return [
                $this->promiseDecorator->decorateTaskCallback($promiseState),
                [$this->promiseDecorator->decorateResolveCallback($promiseState), $this->promiseDecorator->decorateRejectCallback($promiseState)]
            ];
        }, $promises);

        $this->coroutineHandler->handleMultiple($asyncTask);
    }

    public function executePromise(LightningPromiseInterface $promise): void
    {

        if ($this->checkExistsInSet($promise)) {
            throw new PromiseAlreadyHandledException($promise->getUid());
        }

        $promiseState = $this->createPromiseState($promise);

        $this->coroutineHandler->handleOne(
            $this->promiseDecorator->decorateTaskCallback($promiseState),
            $this->promiseDecorator->decorateResolveCallback($promiseState),
            $this->promiseDecorator->decorateRejectCallback($promiseState)
        );
    }

    public function waitForPromise(LightningPromiseInterface $promise, int $timeout = Concurrency::PROMISE_WAIT_INFINITELY): void
    {
        if (!$this->checkExistsInSet($promise)) {
            throw new PromiseNotHandledException($promise->getUid());
        }

        $promiseState = $this->getPromiseState($promise);

        $promiseState->getWaitGroup()->wait($timeout);

        $this->cleanPromiseState($promise);
    }

    private function checkExistsInSet(LightningPromiseInterface $promise): bool
    {
        return isset($this->promisesSet[$promise->getUid()]);
    }

    private function getPromiseState(LightningPromiseInterface $promise): PromiseState
    {
        return $this->promisesSet[$promise->getUid()];
    }

    private function cleanPromiseState(LightningPromiseInterface $promise): void
    {
        unset($this->promisesSet[$promise->getUid()]);
    }

    private function createPromiseState(LightningPromiseInterface $promise): PromiseStateInterface
    {
        $promiseState = PromiseState::build($promise);

        $this->promisesSet[$promise->getUid()] = $promiseState;

        return $promiseState;
    }
}