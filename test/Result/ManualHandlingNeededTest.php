<?php

declare(strict_types=1);

namespace Result;

use Impiura\Error;
use Impiura\Result\ManualHandlingNeeded;
use PHPUnit\Framework\TestCase;

class ManualHandlingNeededTest extends TestCase
{
    public function testIsManualHandlingNeeded()
    {
        $result =
            new ManualHandlingNeeded(
                new class implements Error {
                    public function isArray(): bool
                    {
                        return false;
                    }

                    public function isString(): bool
                    {
                        return false;
                    }

                    public function value()
                    {
                        return false;
                    }
                }
            );

        $this->assertFalse($result->isDeclined());
        $this->assertTrue($result->isManualHandlingNeeded());
        $this->assertFalse($result->isRetryable());
        $this->assertFalse($result->isSuccessful());
    }
}
