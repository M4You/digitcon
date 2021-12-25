<?php

namespace Digitcon\Exceptions;

use InvalidArgumentException;

class InvalidSystemNumberExeption extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Passed number is incorrect for passed numeral system');
    }
}
