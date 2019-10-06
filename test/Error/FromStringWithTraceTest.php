<?php

declare(strict_types=1);

namespace Error;

use Impiura\Error\FromStringWithTrace;
use PHPUnit\Framework\TestCase;

class FromStringWithTraceTest extends TestCase
{
    public function testSuccessful()
    {
        $result = new FromStringWithTrace('errrrror');

        $this->assertTrue($result->isString());
        $this->assertContains("message: errrrror\ntrace: #0", $result->value());
    }
}
