<?php

namespace Digitcon\Models;

use InvalidArgumentException;

class System
{
    public const MIN_VALUE = 2;
    public const MAX_VALUE = 36;

    protected int $value;
    protected int $digitSize;
    protected string $regexPattern;

    public function __construct(int $value)
    {
        if ($value < self::MIN_VALUE || $value > self::MAX_VALUE) {
            throw new InvalidArgumentException('Value is out of range');
        }

        $this->value = $value;
        $this->digitSize = $this->value - 1;
        $this->regexPattern = $this->buildRegexPattern();
    }

    public function getDigitSize(): int
    {
        return $this->digitSize;
    }

    public function getRegexPattern(): string
    {
        return $this->regexPattern;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    protected function buildRegexPattern(): string
    {
        if ($this->digitSize < 10) {
            return "/[^0-{$this->digitSize}]/";
        }

        if ($this->digitSize == 10) {
            return '/[^0-9A]/';
        }

        return '/[^0-9A-' . chr($this->digitSize - 10 + 65) . ']/';
    }
}
