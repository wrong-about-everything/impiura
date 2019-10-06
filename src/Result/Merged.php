<?php

declare(strict_types=1);

namespace Impiura\Result;

use Impiura\Error;
use Impiura\Result;
use Impiura\Value;
use Impiura\Value\Emptie;
use Impiura\Value\Present;

class Merged implements Result
{
    private $results;
    private $result;

    public function __construct(Result ...$results)
    {
        $this->results = $results;
    }

    public function isSuccessful(): bool
    {
        return $this->cachedResult()->isSuccessful();
    }

    public function isManualHandlingNeeded(): bool
    {
        return $this->cachedResult()->isManualHandlingNeeded();
    }

    public function isRetryable(): bool
    {
        return $this->cachedResult()->isRetryable();
    }

    public function isDeclined(): bool
    {
        return $this->cachedResult()->isDeclined();
    }

    public function value(): Value
    {
        return $this->cachedResult()->value();
    }

    public function error(): Error
    {
        return $this->cachedResult()->error();
    }

    private function cachedResult(): Result
    {
        if (is_null($this->result)) {
            $this->mergeResults();
        }

        return $this->result;
    }

    private function mergeResults()
    {
        $values = null;

        foreach ($this->results as $result) {
            if (!$result->isSuccessful()) {
                $this->result = $result;

                return;
            }

            if ($result->value()->isPresent()) {
                $resultValue = $result->value()->value();
                if (is_null($values)) {
                    $values = $resultValue;
                } else {
                    $values =
                        array_merge_recursive(
                            is_array($values) ? $values : [$values],
                            is_array($resultValue) ? $resultValue : [$resultValue]
                        );
                }
            }
        }

        $this->result =
            new Successful(
                is_null($values) ? new Emptie() : new Present($values)
            );
    }
}