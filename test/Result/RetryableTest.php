<?php

declare(strict_types=1);

namespace Result;

use Impiura\Error;
use Impiura\Result\Retryable;
use PHPUnit\Framework\TestCase;

class RetryableTest extends TestCase
{
    public function testIsManualHandlingNeeded()
    {
        $result =
            new Retryable(
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
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertTrue($result->isRetryable());
        $this->assertFalse($result->isSuccessful());
    }
}
