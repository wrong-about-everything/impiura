<?php

declare(strict_types=1);

namespace Impiura\Error;

use Impiura\Error;

abstract class ErrorString implements Error
{
    public function isArray(): bool
    {
        return false;
    }

    public function isString(): bool
    {
        return true;
    }
}