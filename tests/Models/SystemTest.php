<?php

namespace Digitcon\Tests\Models;

use InvalidArgumentException;
use Digitcon\Models\System;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function testSuccessfullyCreatedInstance()
    {
        $this->assertInstanceOf(System::class, new System(2));
    }

    public function testCreateInstanceThrowExceptionWithLessValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $system = new System(1);
    }

    public function testCreateInstanceThrowExceptionWithGreaterValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $system = new System(37);
    }

    public function regexPatternsProvider()
    {
        return [
            [2, '/[^0-1]/'],
            [8, '/[^0-7]/'],
            [11, '/[^0-9A]/'],
            [16, '/[^0-9A-F]/']
        ];
    }

    /**
     * @dataProvider regexPatternsProvider
     */
    public function testCorrectRegexPattern(int $system, string $expected)
    {
        $this->assertEquals($expected, (new System($system))->getRegexPattern());
    }
}
