<?php


namespace Sflightning\Lib\Concurrency\Promise\Exception;


use Sflightning\Contracts\Concurrency\Promise\LightningPromiseInterface;

class InvalidPromiseTypeException extends \RuntimeException
{
    /**         Constructor         **/

    public function __construct($given)
    {
        parent::__construct(sprintf('You must provide an instance of %, %s given.', LightningPromiseInterface::class, $given ? get_class($given) : 'null'));
    }
}