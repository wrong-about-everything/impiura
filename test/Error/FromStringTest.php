<?php

declare(strict_types=1);

namespace Error;

use Impiura\Error\FromString;
use PHPUnit\Framework\TestCase;

class FromStringTest extends TestCase
{
    public function testSuccessful()
    {
        $result = new FromString('string');
        $this->assertTrue($result->isString());
        $this->assertFalse($result->isArray());
        $this->assertEquals('string', $result->value());
    }
}
