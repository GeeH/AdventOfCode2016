<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 03/12/2016
 * Time: 14:06
 */

namespace Advent2016\DayThree;


class Triangle
{
    /**
     * @var bool
     */
    private $partTwo;
    private $map = [];

    public function __construct(bool $partTwo = false)
    {
        $this->partTwo = $partTwo;
    }

    public function findValid(string $triangleList) : int
    {
        $valid = 0;
        $triangles = explode(PHP_EOL, $triangleList);

        if (!$this->partTwo) {
            foreach ($triangles as $triangle) {
                $valid += $this->handleTriangle($triangle);
            }
            return $valid;
        }

        $this->buildMap($triangles);
        $valid += $this->findValidColumns();
        return $valid;

    }

    private function handleTriangle(string $triangle) : int
    {
        $matches = $this->parseString($triangle);
        if ($this->isValidTriangle($matches[1], $matches[2], $matches[3])) {
            return 1;
        }

        return 0;
    }

    private function isValidTriangle(int $side1, int $side2, int $side3) : bool
    {
        return
            $side1 + $side2 > $side3
            && $side2 + $side3 > $side1
            && $side1 + $side3 > $side2;
    }

    private function buildMap(array $triangles)
    {
        foreach ($triangles as $triangle) {
            $sides = $this->parseString($triangle);
            $this->map[0][] = $sides[1];
            $this->map[1][] = $sides[2];
            $this->map[2][] = $sides[3];
        }
    }

    /**
     * @param string $triangle
     * @return mixed
     */
    private function parseString(string $triangle) : array
    {
        preg_match('#\s?(\d+)\s+(\d+)\s+(\d+)#', $triangle, $matches);
        return $matches;
    }

    private function findValidColumns() : int
    {
        $valid = 0;
        foreach ($this->map as $column) {
            $valid += $this->findInColumn($column);
        }
        return $valid;
    }

    private function findInColumn(array $column) : int
    {
        $count = 0;
        while (count($column) > 2) {
            $side1 = array_shift($column);
            $side2 = array_shift($column);
            $side3 = array_shift($column);

            if ($this->isValidTriangle($side1, $side2, $side3)) {
                $count++;
            }
        }
        return $count;
    }
}