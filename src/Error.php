<?php

declare(strict_types=1);

namespace Impiura;

interface Error
{
    public function isArray(): bool;

    public function isString(): bool;

    public function value();
}