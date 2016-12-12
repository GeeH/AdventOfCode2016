<?php

namespace Advent2016\DayTwo;


class Keypad
{
    private $keypad = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
    private $locationX = 1;
    private $locationY = 1;

    public function __construct(bool $partTwo = false)
    {
        if ($partTwo) {
            $this->keypad = [
                [0, 0, 1, 0, 0],
                [0, 2, 3, 4, 0],
                [5, 6, 7, 8, 9],
                [0, 'A', 'B', 'C', 0],
                [0, 0, 'D', 0, 0]
            ];
            $this->locationX = 0;
            $this->locationY = 2;
        }
    }

    public function getCode(string $directions) : string
    {
        $code = '';
        $lines = explode(PHP_EOL, $directions);
        foreach ($lines as $line) {
            $code .= $this->handleLine($line);
        }

        return $code;
    }

    private function handleLine(string $line) : string
    {
        $directions = str_split($line);
        foreach ($directions as $direction) {
            $this->moveDirection($direction);
        }
        return $this->keypad[$this->locationY][$this->locationX];
    }

    private function moveDirection(string $direction)
    {
        switch ($direction) {
            case 'U':
                $this->moveUp();
                break;
            case 'D':
                $this->moveDown();
                break;
            case 'L':
                $this->moveLeft();
                break;
            case 'R':
                $this->moveRight();
                break;
        }
    }

    private function moveUp()
    {
        if ($this->locationY === 0) {
            return;
        }
        if ($this->keypad[$this->locationY - 1][$this->locationX] === 0) {
            return;
        }
        $this->locationY--;
    }

    private function moveDown()
    {
        if ($this->locationY === (count($this->keypad) - 1)) {
            return;
        }
        if ($this->keypad[$this->locationY + 1][$this->locationX] === 0) {
            return;
        }
        $this->locationY++;
    }

    private function moveLeft()
    {
        if ($this->locationX === 0) {
            return;
        }
        if ($this->keypad[$this->locationY][$this->locationX - 1] === 0) {
            return;
        }
        $this->locationX--;
    }

    private function moveRight()
    {
        if ($this->locationX === (count($this->keypad[$this->locationY]) - 1)) {
            return;
        }
        if ($this->keypad[$this->locationY][$this->locationX + 1] === 0) {
            return;
        }
        $this->locationX++;
    }
}