<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 01/12/2016
 * Time: 08:42
 */

namespace Advent2016Test\DayOne;


use Advent2016\DayOne\Mapper;


class MapperTest extends \PHPUnit_Framework_TestCase
{
    public function testMapperSolvesExamples()
    {
        $mapper = new Mapper();

        self::assertEquals(5, $mapper->mapRoute('R2, L3'));
        self::assertEquals(2, $mapper->mapRoute('R2, R2, R2'));
        self::assertEquals(12, $mapper->mapRoute('R5, L5, R5, R3'));
        self::assertEquals(10, $mapper->mapRoute('R10'));
    }
}
