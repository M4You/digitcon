<?php

namespace Digitcon\Types;

use Digitcon\Types\Numeric;

class Hex extends Numeric
{
    protected static string $label = 'hex';

    protected static function validate(string $original): bool
    {
        return preg_match_all("/[^0-9A-F]/m", $original, $matches, PREG_SET_ORDER, 0) === 0;
    }
}
