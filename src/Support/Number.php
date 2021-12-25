<?php

namespace Digitcon\Support;

use Digitcon\Exceptions\InvalidSystemNumberExeption;
use Digitcon\Support\System;
use InvalidArgumentException;

class Number
{
    protected System $system;
    protected $number;
    protected array $numberAsArray;

    public function __construct($number, $system)
    {
        self::validate($number, $system);

        $this->system = $system instanceof System
            ? $system
            : new System($system);

        if (!$this->system->validateNumber($number)) {
            throw new InvalidSystemNumberExeption();
        }

        $this->number = $number;
        $this->numberAsArray = str_split($this->number);
    }

    protected static function validate($number, $system): void
    {
        if (!(is_int($system) || $system instanceof System)) {
            throw new InvalidArgumentException();
        }

        if (!(is_int($number) || is_string($number))) {
            throw new InvalidArgumentException();
        }
    }

    public function toArray(): array
    {
        return $this->numberAsArray;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
