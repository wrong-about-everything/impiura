<?php

declare(strict_types=1);

namespace Impiura\Result;

class Declined extends Failed
{
    public function isDeclined(): bool
    {
        return true;
    }
}