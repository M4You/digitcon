<?php

namespace Digitcon;

use Digitcon\Types\Bin;
use Digitcon\Types\Dec;
use Digitcon\Types\Numeric;
use Digitcon\Convertable\ConveratableToBin;
use Digitcon\Convertable\ConveratableToDec;
use Digitcon\Convertable\ConveratableToHex;
use Digitcon\Convertable\ConveratableToOct;
use Digitcon\Exceptions\UnavailableNumericTypeException;

class Digitcon
{
    protected $numeric;

    protected $availableNumericTypes = [
        Dec::class,
        Bin::class
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

        if ($this->numeric instanceof ConveratableToDec) {
            $result['dec'] = $this->numeric->convertToDec()->toString();
        }

        if ($this->numeric instanceof ConveratableToBin) {
            $result['bin'] = $this->numeric->convertToBin()->toString();
        }

        if ($this->numeric instanceof ConveratableToOct) {
            $result['oct'] = $this->numeric->convertToOct()->toString();
        }

        if ($this->numeric instanceof ConveratableToHex) {
            $result['hex'] = $this->numeric->convertToHex()->toString();
        }

        return $result;
    }

    public function toArray(): array
    {
        return [
            $this->numeric->getLabel() => $this->numeric->toString(),
            'converted' => $this->convertToAll()
        ];
    }
}
