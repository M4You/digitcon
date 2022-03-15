<?php

namespace Digitcon\Models;

use Digitcon\Models\System;
use InvalidArgumentException;

class Digit
{
    public const MAX_SIZE = System::MAX_VALUE - 1;
    public const MIN_CHAR_DIGIT = 10;

    protected int $digit;
    protected int $value;

    public function __construct($value)
    {
        self::validate($value);

        $this->value = $value;
    }

    public function __toString(): string
    {
        if ($this->value > self::MIN_CHAR_DIGIT) {
            return chr($this->value - self::MIN_CHAR_DIGIT + 65);
        }

        return (string)$this->value;
    }

    protected static function validate($value): void
    {
        if (!(is_int($value) || is_string($value))) {
            throw new InvalidArgumentException('Passed $digit argument has unsupported type. Supported only (int) or (string) types');
        }

        if (is_int($value) && ($value < 0 || $value > self::MAX_SIZE)) {
            throw new InvalidArgumentException('Passed $digit argument is out of supported range');
        } elseif (is_string($value) && (strlen($value) != 1 || !ctype_upper($value))) {
            throw new InvalidArgumentException('Passed $digit argument is invalid string value');
        }
    }
}
