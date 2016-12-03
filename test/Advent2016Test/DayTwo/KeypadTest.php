<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 03/12/2016
 * Time: 13:06
 */

namespace Advent2016Test\DayTwo;


use Advent2016\DayTwo\Keypad;

class KeypadTest extends \PHPUnit_Framework_TestCase
{
    private $directions = <<<DIRECTIONS
ULL
RRDDD
LURDL
UUUUD
DIRECTIONS;

    public function testExamplesWork()
    {
        $keypad = new Keypad();
        self::assertEquals('1985', $keypad->getCode($this->directions));
    }

    public function testExamplesWorkPartTwo()
    {
        $keypad = new Keypad(true);
        self::assertEquals('5DB3', $keypad->getCode($this->directions));
    }
}
