<?php

namespace Sflightning\Lib\Concurrency\Promise\Exception;

class PromiseAlreadyHandledException extends \RuntimeException
{
    /**         Constructor         **/

    public function __construct($promiseUid)
    {
        parent::__construct(sprintf('Promise %s is already handled by the concurrency manager', $promiseUid));
    }
}