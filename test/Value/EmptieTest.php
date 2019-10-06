<?php

declare(strict_types=1);

namespace Value;

use Impiura\Value\Emptie;
use PHPUnit\Framework\TestCase;
use Throwable;

class EmptieTest extends TestCase
{
    public function testEmptieIsNotPresent()
    {
        $this->assertFalse((new Emptie())->isPresent());
    }

    public function testEmptieValue()
    {
        try {
            (new Emptie())->value();
            $this->fail('Exception expected');
        } catch (Throwable $throwable) {
            $this->assertEquals('You cannot get value of empty result', $throwable->getMessage());
        }
    }
}
