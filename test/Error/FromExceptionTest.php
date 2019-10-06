<?php

declare(strict_types=1);

namespace Error;

use Exception;
use Impiura\Error\FromException;
use PHPUnit\Framework\TestCase;

class FromExceptionTest extends TestCase
{
    public function testSuccessful()
    {
        $result =
            new FromException(
                new Exception('exception')
            );

        $this->assertTrue($result->isArray());
        $this->assertEquals('exception', $result->value()['message']);
        $this->assertNotEmpty($result->value()['trace']);
    }
}
