<?php

namespace Digitcon\Types;

use Digitcon\Convertable\ConveratableToBin;
use Digitcon\Convertable\ConveratableToHex;
use Digitcon\Convertable\ConveratableToOct;
use Digitcon\Types\Numeric;

class Dec extends Numeric implements ConveratableToBin, ConveratableToOct, ConveratableToHex
{
    public static function validate(string $original): bool
    {
        if (strlen($original) > 1 && (int)substr($original, 0, 1) === 0) {
            return false;
        }

        return preg_match_all("/[^0-9]/m", $original, $matches, PREG_SET_ORDER, 0) === 0;
    }

    public static function toBin($numeric): Bin
    {
        if ($numeric instanceof self) {
            return $numeric->convertToBin();
        }

        return (new Dec($numeric))->convertToBin();
    }

    public function convertToBin(): Bin
    {
        $numeric = (int)$this->original;
        $temp = 0;
        $result = [];

        while ($numeric > 0) {
            $temp = $numeric % 2;
            $numeric = intdiv($numeric, 2);
            array_unshift($result, $temp);
        }

        $resultLen = count($result);

        // if ($resultLen % 4) {
        //     $result = [
        //         ...array_fill(0, $resultLen < 4 ? 4 - $resultLen : $resultLen - intdiv($resultLen, 4) * 4, 0),
        //         ...$result
        //     ];
        // }

        $result = implode('', $result);

        return new Bin($result);
    }

    public static function toOct($numeric): Oct
    {
        if ($numeric instanceof self) {
            return $numeric->convertToOct();
        }

        return (new Dec($numeric))->convertToOct();
    }

    public function convertToOct(): Oct
    {
        $numeric = (int)$this->original;
        $temp = 0;
        $result = [];

        while ($numeric > 0) {
            $temp = $numeric % 8;
            $numeric = intdiv($numeric, 8);
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

        return (new Dec($numeric))->convertToHex();
    }

    public function convertToHex(): Hex
    {
        $numeric = (int)$this->original;
        $temp = 0;
        $result = [];
        $replace = [10 => 'A', 11 => 'B', 12 => 'C', 13 => 'D', 14 => 'E', 15 => 'F'];

        while ($numeric > 0) {
            $temp = $numeric % 16;
            $numeric = intdiv($numeric, 16);
            array_unshift($result, array_key_exists($temp, $replace) ? $replace[$temp] : $temp);
        }

        $result = implode('', $result);

        return new Hex($result);
    }
}
