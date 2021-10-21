<?php

namespace Digitcon\Types;

use Exception;
use Digitcon\Exceptions\InvalidValuePassedException;

abstract class Numeric
{
    protected string $original;

    public function __construct(string $numeric)
    {
        $this->original = $numeric;

        if (!static::validate($this->original)) {
            throw new InvalidValuePassedException();
        }
    }

    public static abstract function validate(string $original): bool;

    public function toArray(): array
    {
        return str_split($this->original);
    }

    public function toString(): string
    {
        return $this->original;
    }
}
