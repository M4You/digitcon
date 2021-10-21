<?php

namespace Digitcon\Exceptions;

use Exception;

class InvalidValuePassedException extends Exception
{
    public function __construct()
    {
        parent::__construct("Passed invalid numeric value");
    }
}
