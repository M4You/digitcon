<?php

namespace Digitcon\Convertable;

use Digitcon\Types\Oct;

interface ConveratableToOct
{
    public static function toOct($numeric): Oct;
    public function convertToOct(): Oct;
}
