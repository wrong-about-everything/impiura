<?php

declare(strict_types=1);

namespace Impiura\Error;

use Exception;

class FromStringWithTrace extends ErrorString
{
    private $message;
    private $exception;

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->exception = new Exception();
    }

    public function value()
    {
        return
            sprintf(
                "message: %s\n"
                . "trace: %s\n",
                $this->message,
                $this->exception->getTraceAsString()
            );
    }
}