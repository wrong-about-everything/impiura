<?php

declare(strict_types=1);

namespace Value;

use Impiura\Value\Present;
use PHPUnit\Framework\TestCase;

class PresentTest extends TestCase
{
    /** @dataProvider values */
    public function testWithDifferentValues($value)
    {
        $result = new Present($value);

        $this->assertTrue($result->isPresent());
        $this->assertEquals($value, $result->value());
    }

    public function values()
    {
        return [
            ['some text'],
            [1488],
            [-0.15],
            [true],
            [null],
            [new class {}],
            [function () {}],
        ];
    }
}
