<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 05/12/2016
 * Time: 12:00
 */

namespace Advent2016\DayFiveTest;


use Advent2016\DayFive\Password;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Password */
    private $password;

    public function setUp()
    {
        $this->password = new Password();
    }

    public function testExamplesPass()
    {
        self::assertEquals('18f47a30', $this->password->getPassword('abc'));
    }

    public function testIsValidHash()
    {
        self::assertTrue($this->password->isValidHash('00000a'));
        self::assertFalse($this->password->isValidHash('000a'));
    }
}
