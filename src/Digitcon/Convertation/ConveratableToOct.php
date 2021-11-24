<?php

namespace Digitcon\Convertation;

use Digitcon\Types\Oct;

interface ConveratableToOct
{
    public static function toOct($numeric): Oct;
    public function convertToOct(): Oct;
}
