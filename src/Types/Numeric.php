<?php

namespace Digitcon\Types;

use Digitcon\Exceptions\InvalidValuePassedException;

abstract class Numeric
{
    protected string $original;
    protected static string $label;

    public function __construct(string $numeric)
    {
        $this->original = $numeric;

        if (!static::validate($this->original)) {
            throw new InvalidValuePassedException();
        }
    }

    protected static abstract function validate(string $original): bool;

    public function toString(): string
    {
        return $this->original;
    }

    public static function getLabel(): string
    {
        return static::$label;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
