<?php

declare(strict_types=1);

namespace Impiura\Error;

use Throwable;

class FromException extends ErrorArray
{
    private $e;

    public function __construct(Throwable $e)
    {
        $this->e = $e;
    }

    public function value()
    {
        return [
            'message' => $this->e->getMessage(),
            'trace' => $this->e->getTraceAsString(),
        ];
    }
}