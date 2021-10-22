<?php

namespace Digitcon;

use Digitcon\Types\Bin;
use Digitcon\Types\Dec;
use Digitcon\Types\Hex;
use Digitcon\Types\Oct;
use Digitcon\Types\Numeric;
use Digitcon\Convertable\ConveratableToBin;
use Digitcon\Convertable\ConveratableToHex;
use Digitcon\Convertable\ConveratableToOct;
use Digitcon\Exceptions\UnavailableNumericTypeException;

class Digitcon
{
    protected $numeric;

    protected $availableNumericTypes = [
        Dec::class
    ];

    public function __construct($input, $type = Dec::class)
    {
        if (!in_array($type, $this->availableNumericTypes)) {
            throw new UnavailableNumericTypeException();
        }

        if ($input instanceof Numeric) {
            if (!in_array(get_class($input), $this->availableNumericTypes)) {
                throw new UnavailableNumericTypeException();
            }

            $this->numeric = $input;
            return;
        }

        $this->numeric = new $type($input);
    }

    public static function toAll($numeric): array
    {
        if ($numeric instanceof self) {
            return $numeric->convertToAll();
        }

        return (new Digitcon($numeric))->convertToAll();
    }

    public function convertToAll(): array
    {
        $result = [];

        if ($this->numeric instanceof ConveratableToBin) {
            $result[] = $this->numeric->convertToBin();
        }

        if ($this->numeric instanceof ConveratableToOct) {
            $result[] = $this->numeric->convertToOct();
        }

        if ($this->numeric instanceof ConveratableToHex) {
            $result[] = $this->numeric->convertToHex();
        }

        return $result;
    }
}
