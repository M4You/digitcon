<?php

namespace Digitcon\Convertable;

use Digitcon\Types\Dec;

interface ConveratableToDec
{
    public static function toDec($numeric): Dec;
    public function convertToDec(): Dec;
}
