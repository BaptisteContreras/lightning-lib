<?php


namespace Sflightning\Lib\Concurrency\Promise\Exception;


use Sflightning\Contracts\Concurrency\Promise\PromiseStateInterface;

class InvalidPromiseStateException extends \RuntimeException
{
    /**         Constructor         **/

    public function __construct(string $promiseDecoratorClass, PromiseStateInterface $promiseState)
    {
        parent::__construct(sprintf('The current promise decorator %s does not support %s promise state type', $promiseDecoratorClass, get_class($promiseState)));
    }
}