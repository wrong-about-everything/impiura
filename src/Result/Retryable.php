<?php

declare(strict_types=1);

namespace Impiura\Result;

class Retryable extends Failed
{
    public function isRetryable(): bool
    {
        return true;
    }
}