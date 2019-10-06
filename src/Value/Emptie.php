<?php

declare(strict_types=1);

namespace Impiura\Value;

use Exception;
use Impiura\Value;

class Emptie implements Value
{
    /** @throws Exception */

    public function value()
    {
        throw new Exception('You cannot get value of empty result');
    }

    public function isPresent(): bool
    {
        return false;
    }
}