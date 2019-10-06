<?php

declare(strict_types=1);

namespace Result;

use Impiura\Error;
use Impiura\Result\Declined;
use PHPUnit\Framework\TestCase;

class DeclinedTest extends TestCase
{
    public function testIsDeclined()
    {
        $result =
            new Declined(
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

        $this->assertTrue($result->isDeclined());
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertFalse($result->isRetryable());
        $this->assertFalse($result->isSuccessful());
    }
}
