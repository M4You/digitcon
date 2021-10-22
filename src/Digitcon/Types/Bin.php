<?php

namespace Digitcon\Types;

use Digitcon\Types\Numeric;

class Bin extends Numeric
{
    public static function validate(string $original): bool
    {
        return preg_match_all("/[^0-1]/m", $original, $matches, PREG_SET_ORDER, 0) === 0;
    }
}