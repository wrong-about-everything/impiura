<?php

declare(strict_types=1);

namespace Impiura\Result;

use \Exception;
use Impiura\Error;
use Impiura\Result;
use Impiura\Value;

class Successful implements Result
{
    private $value;

    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    public function isSuccessful(): bool
    {
        return true;
    }

    public function value(): Value
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    public function error(): Error
    {
        throw new Exception('Successful result does not have an error');
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
}