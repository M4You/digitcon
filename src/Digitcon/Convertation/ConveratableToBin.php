<?php

namespace Digitcon\Convertation;

use Digitcon\Types\Bin;

interface ConveratableToBin
{
    public static function toBin($numeric): Bin;
    public function convertToBin(): Bin;
}
