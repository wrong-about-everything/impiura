<?php

declare(strict_types=1);

namespace Impiura;

interface Value
{
    public function value();

    public function isPresent(): bool;
}