<?php

namespace Digitcon\Models;

use Digitcon\Models\System;
use InvalidArgumentException;

class Number
{
    protected System $system;
    protected array $value;
    protected string $stringValue;

    public function __construct($value, $system)
    {
        if (!(is_int($system) || $system instanceof System)) {
            throw new InvalidArgumentException('Unsupported type');
        }

        $system = is_int($system) ? new System($system) : $system;

        if (!(is_int($value) || is_string($value))) {
            throw new InvalidArgumentException('Unsupported type');
        }

        if (preg_match_all($system->getRegexPattern(), $value, $matches, PREG_SET_ORDER, 0) !== 0) {
            throw new InvalidArgumentException('Passed $number is invalid for passed $system');
        }

        foreach (str_split((string)$value) as $v) {
            $this->value[] = new Digit($v);
        }

        $this->stringValue = $value;
    }

    public function __toString(): string
    {
        return $this->stringValue;
    }
}
