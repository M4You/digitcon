<?php

namespace Digitcon\Tests\Models;

use Digitcon\Models\Digit;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DigitTest extends TestCase
{
    public function testSuccesfullyCreatedInstance()
    {
        $this->assertInstanceOf(Digit::class, new Digit(35));
    }

    public function testCreateInstanceThrowExceptionWithInvalidArgumentType()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $digit argument has unsupported type. Supported only (int) or (string) types');

        $digit = new Digit(true);
    }

    public function testCreateInstanceThrowExceptionWithInvalideDigitValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $digit argument is out of supported range');

        $digit = new Digit(36);
    }

    public function testCreateInstanceThrowExceptionWithInvalidStringValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $digit argument is invalid string value');

        $digit = new Digit('AA');
    }
}
