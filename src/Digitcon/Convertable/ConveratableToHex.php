<?php

namespace Digitcon\Convertable;

use Digitcon\Types\Hex;

interface ConveratableToHex
{
    public static function toHex($numeric): Hex;
    public function convertToHex(): Hex;
}
