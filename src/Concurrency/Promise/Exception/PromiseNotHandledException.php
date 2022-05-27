<?php


namespace Sflightning\Lib\Concurrency\Promise\Exception;


class PromiseNotHandledException extends \RuntimeException
{
    /**         Constructor         **/

    public function __construct($promiseUid)
    {
        parent::__construct(sprintf('Promise %s is not already handled by the concurrency manager. You should call executePromise method first', $promiseUid));
    }
}