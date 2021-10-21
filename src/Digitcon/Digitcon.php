<?php

namespace Digitcon;

use Digitcon\Exceptions\UnavailableNumericTypeException;
use Digitcon\Types\Decimal;
use Digitcon\Types\Numeric;

class Digitcon
{
    protected $numeric;

    protected $availableNumericTypes = [
        Decimal::class
    ];

    public function __construct($input, $type = Decimal::class)
    {
        if (!in_array($type, $this->availableNumericTypes)) {
            throw new UnavailableNumericTypeException();
        }

        if ($input instanceof Numeric) {
            if (!in_array(get_class($input), $this->availableNumericTypes)) {
                throw new UnavailableNumericTypeException();
            }

            $this->numeric = $input;
            return;
        }

        $this->numeric = new $type($input);
    }
}
