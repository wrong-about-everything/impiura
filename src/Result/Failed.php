<?php

namespace Impiura\Result;

use Exception;
use Impiura\Error;
use Impiura\Result;
use Impiura\Value;

abstract class Failed implements Result
{
    private $error;

    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * @throws Exception
     */
    public function value(): Value
    {
        throw new Exception('Can not obtain value on Failed result. Error is ' . $this->errorString());
    }

    public function error(): Error
    {
        return $this->error;
    }

    public function isManualHandlingNeeded(): bool
    {
        return false;
    }

    public function isRetryable(): bool
    {
        return false;
    }

    public function isDeclined(): bool
    {
        return false;
    }

    private function errorString()
    {
        return
            $this->error()->isArray()
                ? var_export($this->error()->value(), true)
                : $this->error()->value()
            ;
    }
}