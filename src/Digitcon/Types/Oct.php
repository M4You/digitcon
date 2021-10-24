<?php

namespace Digitcon\Types;

use Digitcon\Types\Numeric;

class Oct extends Numeric
{
    protected static string $label = 'oct';

    protected static function validate(string $original): bool
    {
        return preg_match_all("/[^0-7]/m", $original, $matches, PREG_SET_ORDER, 0) === 0;
    }
}
