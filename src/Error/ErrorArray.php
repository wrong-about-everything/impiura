<?php

declare(strict_types=1);

namespace Impiura\Error;

use Impiura\Error;

abstract class ErrorArray implements Error
{
    public function isArray(): bool
    {
        return true;
    }

    public function isString(): bool
    {
        return false;
    }
}
