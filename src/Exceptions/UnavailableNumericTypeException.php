<?php

namespace Digitcon\Exceptions;

use Exception;

class UnavailableNumericTypeException extends Exception
{
    public function __construct()
    {
        parent::__construct("Trying to init unavailable type of Numeric::class");
    }
}
