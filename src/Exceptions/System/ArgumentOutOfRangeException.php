<?php

namespace Digitcon\Exceptions;

use InvalidArgumentException;

class ArgumentOutOfRangeException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Passed numeral system value is out of range');
    }
}
