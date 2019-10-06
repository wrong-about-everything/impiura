<?php

declare(strict_types=1);

namespace Impiura\Tests\Result;

use Impiura\Error\FromString;
use Impiura\Result\Declined;
use Impiura\Result\ManualHandlingNeeded;
use Impiura\Result\Merged;
use Impiura\Result\Retryable;
use Impiura\Result\Successful;
use Impiura\Value\Emptie;
use Impiura\Value\Present;
use PHPUnit\Framework\TestCase;

class MergedTest extends TestCase
{
    public function testMergeRecursive()
    {
        $r =
            (new Merged(
                new Successful(
                    new Present(
                        [
                            'val' => [
                                7,
                                'sub' => 'two',
                                666
                            ],
                            13,
                        ]
                    )
                ),
                new Successful(
                    new Present(
                        [
                            5,
                            'val' => [
                                1488,
                                'sub' => 'one',
                                1,
                            ],
                        ]
                    )
                ),
                new Successful(new Present([]))
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertTrue($r->value()->isPresent());
        $this->assertEquals(
            [
                0 => 13,    // index is 0 since 13 was first to occur
                1 => 5,     // index is 1 since 5 was second
                'val' => [
                    'sub' => [
                        0 => 'two', // index is 0 since 'two' was first to occur
                        1 => 'one'  // index is 1 since 'one' was second
                    ],
                    0 => 7, // index is 0 since named indexes are treated separately
                    1 => 666,
                    2 => 1488,
                    3 => 1
                ],
            ],
            $r->value()->value()
        );
    }

    public function testAllResultsAreEmpty()
    {
        $r =
            (new Merged(
                new Successful(new Emptie()),
                new Successful(new Emptie())
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertFalse($r->value()->isPresent());
    }

    public function testEmptyValueAndEmptyArray()
    {
        $r =
            (new Merged(
                new Successful(new Emptie()),
                new Successful(new Present([]))
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertTrue($r->value()->isPresent());
        $this->assertEquals([], $r->value()->value());
    }

    public function testScalarValueAndArrayValue()
    {
        $r =
            (new Merged(
                new Successful(new Present('scalar')),
                new Successful(new Present(['key' => 'value']))
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertTrue($r->value()->isPresent());
        $this->assertEquals(
            [
                '0' => 'scalar',
                'key' => 'value',
            ],
            $r->value()->value()
        );
    }

    public function testArrayValueAndScalarValue()
    {
        $r =
            (new Merged(
                new Successful(new Present(['key' => 'value'])),
                new Successful(new Present('scalar'))
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertTrue($r->value()->isPresent());
        $this->assertEquals(
            [
                'key' => 'value',
                '0' => 'scalar',
            ],
            $r->value()->value()
        );
    }

    public function testAllEmptyArrays()
    {
        $r =
            (new Merged(
                new Successful(new Present([])),
                new Successful(new Present([]))
            ));

        $this->assertTrue($r->isSuccessful());
        $this->assertTrue($r->value()->isPresent());
        $this->assertEquals([], $r->value()->value());
    }

    public function testSomeResultsAreFailed()
    {
        $r =
            (new Merged(
                new Successful(new Present([])),
                new Declined(new FromString('msg1')),
                new Successful(new Present([]))
            ));

        $this->assertFalse($r->isSuccessful());
        $this->assertTrue($r->isDeclined());
        $this->assertEquals('msg1', $r->error()->value());
    }

    public function testMixedFailedResults()
    {
        $r =
            (new Merged(
                new ManualHandlingNeeded(new FromString('manual')),
                new Retryable(new FromString('retryable')),
                new Declined(new FromString('decline'))
            ));

        $this->assertFalse($r->isSuccessful());
        $this->assertTrue($r->isManualHandlingNeeded()); // ManualHandlingNeeded was first to occur
        $this->assertFalse($r->isDeclined());
        $this->assertFalse($r->isRetryable());
        $this->assertEquals('manual', $r->error()->value());
    }
}
