<?php

declare(strict_types=1);

namespace Impiura\Value;

use Impiura\Value;

class Present implements Value
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function isPresent(): bool
    {
        return true;
    }
}