<?php

namespace Digitcon\Models;

use Digitcon\Models\System;
use InvalidArgumentException;

class Number
{
    protected System $system;
    protected string $value;

    public function __construct($value, $system)
    {
        self::validate($value, $system);

        $this->value = $value;
        $this->system = is_int($system) ? new System($system) : $system;
    }

    public function toArray(): array
    {
        return str_split($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    protected static function validate($value, $system): void
    {
        if (!(is_int($system) || $system instanceof System)) {
            throw new InvalidArgumentException('Passed $system argument has unsupported type. Supported only (int) type or Digitcon\Models\System::class instance');
        }

        $system = is_int($system) ? new System($system) : $system;

        if (!(is_int($value) || is_string($value))) {
            throw new InvalidArgumentException('Passed $number argument has unsupported type. Supported only (int) or (string) types');
        }

        if (preg_match_all($system->getRegexPattern(), $value, $matches, PREG_SET_ORDER, 0) !== 0) {
            throw new InvalidArgumentException('Passed $number is invalid for passed $system');
        }
    }
}
