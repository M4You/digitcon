<?php

namespace Digitcon\Convertable;

use Digitcon\Types\Bin;

interface ConveratableToBin
{
    public static function toBin($numeric): Bin;
    public function convertToBin(): Bin;
}
