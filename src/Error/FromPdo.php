<?php

declare(strict_types=1);

namespace Impiura\Error;

use PDO;

class FromPdo extends ErrorArray
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function value()
    {
        return [
            'code' => $this->pdo->errorCode(),
            'extended' => $this->pdo->errorInfo(),
        ];
    }
}
