<?php

namespace Digitcon\Types;

use Digitcon\Convertable\ConveratableToDec;
use Digitcon\Convertable\ConveratableToHex;
use Digitcon\Convertable\ConveratableToOct;
use Digitcon\Types\Numeric;

class Bin extends Numeric implements ConveratableToDec, ConveratableToOct, ConveratableToHex
{
    protected static string $label = 'bin';

    protected static function validate(string $original): bool
    {
        return preg_match_all("/[^0-1]/m", $original, $matches, PREG_SET_ORDER, 0) === 0;
    }

    public static function toDec($numeric): Dec
    {
        if ($numeric instanceof self) {
            return $numeric->convertToDec();
        }

        return (new Bin($numeric))->convertToDec();
    }

    public function convertToDec(): Dec
    {
        $result = 0;
        $originalAsArr = str_split($this->original);
        $originalAsArr = array_reverse($originalAsArr);

        foreach ($originalAsArr as $k => $v) {
            $result += $v ? pow(2, $k) : 0;
        }

        return new Dec($result);
    }

    public static function toOct($numeric): Oct
    {
        if ($numeric instanceof self) {
            return $numeric->convertToOct();
        }

        return (new Bin($numeric))->convertToOct();
    }

    public function convertToOct(): Oct
    {
        $result = [];
        $step = $temp = 0;
        $originalAsArr = str_split($this->original);
        $originalAsArr = array_reverse($originalAsArr);

        foreach ($originalAsArr as $v) {
            $temp += $v ? pow(2, $step) : 0;

            if ($step == 2) {
                array_unshift($result, $temp);
                $step = $temp = 0;
                continue;
            }

            $step++;
        }

        if ($temp) {
            array_unshift($result, $temp);
        }

        $result = implode('', $result);

        return new Oct($result);
    }


    public static function toHex($numeric): Hex
    {
        if ($numeric instanceof self) {
            return $numeric->convertToHex();
        }

        return (new Bin($numeric))->convertToHex();
    }

    public function convertToHex(): Hex
    {
        $result = [];
        $step = $temp = 0;
        $originalAsArr = str_split($this->original);
        $originalAsArr = array_reverse($originalAsArr);
        $replace = [10 => 'A', 11 => 'B', 12 => 'C', 13 => 'D', 14 => 'E', 15 => 'F'];

        foreach ($originalAsArr as $v) {
            $temp += $v ? pow(2, $step) : 0;

            if ($step == 3) {
                array_unshift($result, array_key_exists($temp, $replace) ? $replace[$temp] : $temp);
                $step = $temp = 0;
                continue;
            }

            $step++;
        }

        if ($temp) {
            array_unshift($result, array_key_exists($temp, $replace) ? $replace[$temp] : $temp);
        }

        $result = implode('', $result);

        return new Hex($result);
    }
}
