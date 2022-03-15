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
        $this->setValue($value);

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

    protected function setValue(int $value): void
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    protected function validateValue(int $value): void
    {
        if ($value < self::MIN_VALUE) {
            throw new InvalidArgumentException("Passed value '{$value}' less then allowable min value " . self::MIN_VALUE);
        }

        if ($value > self::MAX_VALUE) {
            throw new InvalidArgumentException("Passed value '{$value}' greater then allowable max value " . self::MAX_VALUE);
        }
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
