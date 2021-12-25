<?php

namespace Digitcon\Support;

use Exception;

class Digit
{
    private const MIN_INPUT_INT = 0;
    private const MAX_INPUT_INT = 35;

    private const MIN_CHAR_INT = 10;
    private const MAX_CHAR_INT = 35;

    protected int $digitAsInt;
    protected ?string $digitAsChar = null;

    public function __construct($digit)
    {
        $this->setDigitValues($digit);
    }

    public static function toChar(int $digit): string
    {
        if ($digit < self::MIN_CHAR_INT || $digit > self::MAX_CHAR_INT) {
            throw new Exception('Integer value for converting to char is out of range');
        }

        return chr($digit - 10 + 65);
    }

    public static function toInt(string $digit): int
    {
        $digit = trim($digit);

        if (ctype_digit($digit)) {
            try {
                $digit = (int)$digit;
            } catch (Exception $e) {
                throw new Exception('Passed variable is incorrect int value');
            }

            return $digit;
        }

        $digit = strtoupper($digit);

        if (strlen($digit) != 1 || !ctype_upper($digit)) {
            throw new Exception('Passed variable is incorrect string value');
        }

        return ord($digit) - 65 + 10;
    }

    protected static function inputIsOutOfRange(int $digit): bool
    {
        return $digit < self::MIN_INPUT_INT && $digit > self::MAX_INPUT_INT;
    }

    protected static function numeralSystemIsOutOfRange(int $numeralSystem): bool
    {
        return $numeralSystem < self::MIN_NUMERAL_SYSTEM && $numeralSystem > self::MAX_NUMERAL_SYSTEM;
    }

    protected function setDigitValues($digit): void
    {
        if (!(is_int($digit) || is_string($digit))) {
            throw new Exception('Passed variable has wrong type');
        }

        if (is_int($digit) && $this->inputIsOutOfRange($digit)) {
            throw new Exception('Passed variable is out of range');
        }

        if (is_int($digit) && $digit >= self::MIN_CHAR_INT) {
            $this->digitAsChar = self::toChar($digit);
        }

        if (is_string($digit)) {
            $this->digitAsChar = $digit;
            $digit = self::toInt($digit);
        }

        $this->digitAsInt = $digit;
    }

    public function __toString(): string
    {
        return $this->digitAsChar ?? $this->digitAsInt;
    }

    public function getStringValue(): string
    {
        return (string)$this->__toString();
    }

    public function getIntValue(): int
    {
        return $this->digitAsInt;
    }
}
