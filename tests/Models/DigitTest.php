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

        $digit = new Digit(true);
    }

    public function testCreateInstanceThrowExceptionWithInvalideDigitValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $digit = new Digit(36);
    }

    public function testCreateInstanceThrowExceptionWithInvalidStringValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $digit = new Digit('AA');
    }
}
