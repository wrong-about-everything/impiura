<?php

declare(strict_types=1);

namespace Impiura\Result;

class ManualHandlingNeeded extends Failed
{
    public function isManualHandlingNeeded(): bool
    {
        return true;
    }
}