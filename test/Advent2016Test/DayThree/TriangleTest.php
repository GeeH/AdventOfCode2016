<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 03/12/2016
 * Time: 14:06
 */

namespace Advent2016Test\DayThree;


use Advent2016\DayThree\Triangle;

class TriangleTest extends \PHPUnit_Framework_TestCase
{
    public function testExamplesWork()
    {
        $triangle = new Triangle();
        self::assertEquals(1, $triangle->findValid('10 10 10'));
        self::assertEquals(0, $triangle->findValid('5 10 25'));
        self::assertEquals(2, $triangle->findValid("10 10 10 \n  10   10   10 \n 5 10 25"));
    }

    public function testExamplesWorkPartTwo()
    {
        $triangles = <<<TRIANGLES
101 301 501
102 302 502
103 303 503
201 401 601
202 402 602
203 403 603
TRIANGLES;

        $triangle = new Triangle(true);
        self::assertEquals(6, $triangle->findValid($triangles));
    }
}
