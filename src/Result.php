<?php

declare(strict_types=1);

namespace Impiura;

interface Result/*<T>*/
{
    public function isSuccessful(): bool;

    public function isManualHandlingNeeded(): bool;

    public function isRetryable(): bool;

    public function isDeclined(): bool;

    public function value(): Value/*: T*/;

    public function error(): Error;
}
