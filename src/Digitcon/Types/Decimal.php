<?php

namespace Digitcon\Types;

use Digitcon\Types\Numeric;

class Decimal extends Numeric
{
    public static function validate(string $original): bool
    {
        if ((int)substr($original, 0, 1) === 0) {
            return false;
        }

        return true;
    }
}
