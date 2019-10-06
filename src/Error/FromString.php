<?php

declare(strict_types=1);

namespace Impiura\Error;

class FromString extends ErrorString
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function value()
    {
        return $this->message;
    }
}