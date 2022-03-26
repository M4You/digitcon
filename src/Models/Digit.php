<?php

namespace Digitcon\Models;

use Exception;
use InvalidArgumentException;

class Digit
{
    public const MIN_SIZE = 0;
    public const MAX_SIZE = 35;
    public const MIN_CHAR = 10;

    protected int $value;
    protected bool $isChar = false;
    protected string $stringValue;

    public function __construct($value)
    {
        $type = gettype($value);

        if (!in_array($type, ['string', 'integer'])) {
            throw new InvalidArgumentException('Unsupported type');
        }

        if ($type === 'string') {
            $value = trim($value);

            if (is_numeric($value)) {
                try {
                    $value = (int)$value;
                    $type = 'integer';
                } catch (Exception $e) {
                    throw new InvalidArgumentException('String is incorrect');
                }
            } elseif (!(ctype_alpha($value) && strlen($value) === 1)) {
                throw new InvalidArgumentException('String is incorrect');
            } else {
                $this->value = ord(strtoupper($value)) - 65 + self::MIN_CHAR;
                $this->stringValue = $value;

                return;
            }
        }


        if ($value < self::MIN_SIZE || $value > self::MAX_SIZE) {
            throw new InvalidArgumentException('Integer is out of range');
        }

        $this->value = $value;
        $this->stringValue = $value >= self::MIN_CHAR
            ? chr($value - self::MIN_CHAR + 65) : (string)$value;
    }

    public function __toString(): string
    {
        return $this->stringValue;
    }
}
