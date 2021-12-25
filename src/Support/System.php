<?php

namespace Digitcon\Support;

use Exception;
use Digitcon\Support\Number;
use Digitcon\Exceptions\ArgumentOutOfRangeException;

class System
{
    private const MIN_NUMERAL_SYSTEM = 2;
    private const MAX_NUMERAL_SYSTEM = 36;

    private const MIN_CHAR_DIGIT = 10;

    protected int $system;
    protected int $minDigit;
    protected int $maxDigit;

    /**
     *
     * @param int $system
     * @return void
     * @throws ArgumentOutOfRangeException
     */
    public function __construct(int $system)
    {
        self::validate($system);

        $this->system = $system;
        $this->minDigit = 0;
        $this->maxDigit = $this->system - 1;
    }

    /**
     * Getting MIN digit value for `$this` numeral system
     *
     * @return int
     */
    public function getMinDigitValue(): int
    {
        return $this->minDigit;
    }

    /**
     * Getting MAX digit value for `$this` numeral system
     *
     * @return int
     */
    public function getMaxDigitValue(): int
    {
        return $this->maxDigit;
    }

    /**
     * Validate passed digit for `$this` numeral system
     *
     * @param int|string|Digit $digit Digit for validation
     * @return bool
     */
    public function validateDigit($digit): bool
    {
        if (!(is_int($digit) || is_string($digit) || $digit instanceof Digit)) {
            return false;
        }

        if (!$digit instanceof Digit) {
            $digit = (new Digit($digit))->getIntValue();
        }

        return $digit >= $this->getMinDigitValue() && $digit <= $this->getMaxDigitValue();
    }

    /**
     * Validate passed number for `$this` numeral system
     *
     * @param int|string|Number $number Number for validation
     * @return bool
     */
    public function validateNumber($number): bool
    {
        if (!(is_int($number) || is_string($number) || $number instanceof Number)) {
            return false;
        }

        if (!$number instanceof Number) {
            $number = (new Number($number, $this->system))->toString();
        }

        return preg_match_all($this->getRegexNumberPattern(), $number, $matches, PREG_SET_ORDER, 0) === 0;
    }

    /**
     * Get ReGex pattern for `$this` numeral system
     *
     * @return string
     * @throws Exception
     */
    public function getRegexNumberPattern(): string
    {
        $maxDigit = $this->getMaxDigitValue();

        if ($maxDigit < self::MIN_CHAR_DIGIT) {
            return "/[^0-{$maxDigit}]/m";
        }

        if ($maxDigit == self::MIN_CHAR_DIGIT) {
            return "/[^0-{$maxDigit}A]/m";
        }

        $maxDigitAsChar = Digit::toChar($maxDigit);

        return "/[^0-{$maxDigit}A-{$maxDigitAsChar}]/m";
    }

    /**
     * Function for validation passed system
     *
     * @param int $system System value for validation
     * @return void
     * @throws ArgumentOutOfRangeException
     */
    protected static function validate(int $system): void
    {
        if ($system < self::MIN_NUMERAL_SYSTEM && $system > self::MAX_NUMERAL_SYSTEM) {
            throw new ArgumentOutOfRangeException();
        }
    }

    /**
     * Getting MIN digit value for passed numeral system
     *
     * @param int $system Numeral system value
     * @return int
     */
    public static function minDigitValueFor(int $system): int
    {
        return (new self($system))->getMinDigitValue();
    }

    /**
     * Getting MAX digit value for passed numeral system
     *
     * @param int $system Numeral system value
     * @return int
     */
    public static function maxDigitValueFor(int $system): int
    {
        return (new self($system))->getMaxDigitValue();
    }

    /**
     * Check if digit is between `MIN` and `MAX` digit for passed numeral system
     *
     * @param int $system System for validation
     * @param int|string|Digit $digit Digit for validation
     * @return bool
     */
    public static function digitInRangeFor(int $system, $digit): bool
    {
        return (new self($system))->validateDigit($digit);
    }

    /**
     * Get ReGex pattern for passed numeral system
     *
     * @param int $system Numeral system
     * @return string
     * @throws Exception
     */
    public static function regexNumberPatternFor(int $system): string
    {
        return (new self($system))->getRegexNumberPattern();
    }
}
