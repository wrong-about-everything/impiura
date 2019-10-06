<?php

declare(strict_types=1);

namespace Error;

use Impiura\Error\DefaultArray;
use PHPUnit\Framework\TestCase;

class DefaultArrayTest extends TestCase
{
    public function testSuccessful()
    {
        $result = new DefaultArray(['key' => 'value']);

        $this->assertTrue($result->isArray());
        $this->assertFalse($result->isString());
        $this->assertEquals(['key' => 'value'], $result->value());
    }
}
