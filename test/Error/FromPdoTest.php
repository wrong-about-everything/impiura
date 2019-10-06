<?php

declare(strict_types=1);

namespace Error;

use Impiura\Error\FromPdo;
use PDO;
use PHPUnit\Framework\TestCase;

class FromPdoTest extends TestCase
{
    public function testSuccessful()
    {
        $result = new FromPdo($this->pdo());
        $this->assertTrue($result->isArray());
        $this->assertEquals(
            [
                'code' => '00000',
                'extended' => ['00000', null, null],
            ],
            $result->value()
        );
    }

    private function pdo(): PDO
    {
        $connection = new PDO('sqlite::memory:');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}
