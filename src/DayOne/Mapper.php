<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 01/12/2016
 * Time: 08:40
 */

namespace Advent2016\DayOne;


class Mapper
{
    private $locationX = 0;
    private $locationY = 0;
    private $direction = 1;

    const DIRECTION_N = 1;
    const DIRECTION_E = 2;
    const DIRECTION_S = 3;
    const DIRECTION_W = 4;

    public function mapRoute(string $directionList) : int
    {
        $this->locationX = 0;
        $this->locationY = 0;
        $this->direction = self::DIRECTION_N;

        $moves = explode(', ', $directionList);
        foreach ($moves as $move) {
            $this->handleMove($move);
        }

        if ($this->locationX < 0) {
            $this->locationX *= -1;
        }
        if ($this->locationY < 0) {
            $this->locationY *= -1;
        }

        return $this->locationX + $this->locationY;
    }

    private function handleMove(string $move) : void
    {
        preg_match('#([R|L])(\d+)#', $move, $matches);
        $direction = $matches[1];
        $steps = $matches[2];

        $this->turn($direction);
        $this->step($steps);
    }

    private function turn(string $direction) : void
    {
        if ($direction === 'R') {
            $this->direction++;
        }
        if ($direction === 'L') {
            $this->direction--;
        }

        if ($this->direction > 4) {
            $this->direction = 1;
        }
        if ($this->direction < 1) {
            $this->direction = 4;
        }
    }

    private function step(int $steps) : void
    {
        switch ($this->direction) {
            case self::DIRECTION_N:
                $this->locationY += $steps;
                break;
            case self::DIRECTION_S:
                $this->locationY -= $steps;
                break;
            case self::DIRECTION_E:
                $this->locationX += $steps;
                break;
            case self::DIRECTION_W:
                $this->locationX -= $steps;
                break;
        }
    }
}
