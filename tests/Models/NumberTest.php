<?php

namespace Digitcon\Tests\Models;

use Digitcon\Models\Number;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testSuccesfullyCreatedInstance()
    {
        $this->assertInstanceOf(Number::class, new Number('100', 10));
    }

    public function testCreateInstanceThrowExceptionWithInvalidSystemArgumentType()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $system argument has unsupported type. Supported only (int) type or Digitcon\Models\System::class instance');

        new Number(1010, null);
    }

    public function testCreateInstanceThrowExceptionWithInvalidNumberArgumentType()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $number argument has unsupported type. Supported only (int) or (string) types');

        new Number(null, 4);
    }

    public function testCreateInstanceThrowExceptionWithInvalidNumberForSystem()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Passed $number is invalid for passed $system');

        new Number(18, 8);
    }
}
