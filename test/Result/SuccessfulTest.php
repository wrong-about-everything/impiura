<?php

declare(strict_types=1);

namespace Result;

use Impiura\Result\Successful;
use Impiura\Value\Emptie;
use Impiura\Value\Present;
use PHPUnit\Framework\TestCase;
use Throwable;

class SuccessfulTest extends TestCase
{
    public function testWithPresentValue()
    {
        $result = new Successful(new Present(''));

        $this->assertTrue($result->isSuccessful());
        $this->assertFalse($result->isRetryable());
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertFalse($result->isDeclined());

        try {
            $result->error();
            $this->fail('Exceptin expected');
        } catch (Throwable $throwable) {
            $this->assertEquals('Successful result does not have an error', $throwable->getMessage());
        }
    }

    public function testWithEmptyValue()
    {
        $result = new Successful(new Emptie());

        $this->assertTrue($result->isSuccessful());
        $this->assertFalse($result->isRetryable());
        $this->assertFalse($result->isManualHandlingNeeded());
        $this->assertFalse($result->isDeclined());
    }
}
