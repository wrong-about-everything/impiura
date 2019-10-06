<?php

declare(strict_types=1);

namespace Impiura\Error;

class DefaultArray extends ErrorArray
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function value()
    {
        return $this->array;
    }
}