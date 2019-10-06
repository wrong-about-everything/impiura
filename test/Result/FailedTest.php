<?php

declare(strict_types=1);

namespace Result;

use Impiura\Error;
use Impiura\Result\Failed;
use PHPUnit\Framework\TestCase;
use Throwable;

class FailedTest extends TestCase
{
    public function testFailedStringValue()
    {
        $result = new class($this->errorWithString('errrrror')) extends Failed {};

        $this->assertFalse($result->isSuccessful());
        $this->assertFalse($result->isDeclined());
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertFalse($result->isRetryable());
        $this->assertTrue($result->error()->isString());
        $this->assertFalse($result->error()->isArray());
        $this->assertEquals('errrrror', $result->error()->value());

        try {
            $result->value();
            $this->fail('Exception expected');
        } catch (Throwable $throwable) {
            $this->assertEquals('Can not obtain value on Failed result. Error is errrrror', $throwable->getMessage());
        }
    }

    public function testFailedArrayValue()
    {
        $result = new class($this->errorWithArray(['some' => 'errrrror'])) extends Failed {};

        $this->assertFalse($result->isSuccessful());
        $this->assertFalse($result->isDeclined());
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertFalse($result->isRetryable());
        $this->assertTrue($result->error()->isArray());
        $this->assertFalse($result->error()->isString());
        $this->assertEquals(['some' => 'errrrror'], $result->error()->value());

        try {
            $result->value();
            $this->fail('Exception expected');
        } catch (Throwable $throwable) {
            $this->assertEquals("Can not obtain value on Failed result. Error is array (\n  'some' => 'errrrror',\n)", $throwable->getMessage());
        }
    }

    private function errorWithArray(array $error)
    {
        return
            new class($error) implements Error {
                private $error;

                public function __construct(array $error)
                {
                    $this->error = $error;
                }

                public function isArray(): bool
                {
                    return true;
                }

                public function isString(): bool
                {
                    return false;
                }

                public function value()
                {
                    return $this->error;
                }
            };
    }

    private function errorWithString(string $error)
    {
        return
            new class($error) implements Error {
                private $error;

                public function __construct(string $error)
                {
                    $this->error = $error;
                }

                public function isArray(): bool
                {
                    return false;
                }

                public function isString(): bool
                {
                    return true;
                }

                public function value()
                {
                    return $this->error;
                }
            };
    }
}
