<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 04/12/2016
 * Time: 12:50
 */

namespace Advent2016\DayFour;


class Decoder
{

    public function split(string $room, bool $removeDashes = true) : array
    {
        preg_match('#([a-z-]+\-)(\d+)\[([a-z]+)\]#', $room, $matches);
        array_shift($matches);
        if ($removeDashes) {
            $matches[0] = str_replace('-', '', $matches[0]);
        }
        return $matches;
    }

    public function isValidRoom(string $name, string $checksum) : bool
    {
        $characterCount = $this->getCharacterCount($name);

        $generatedChecksum = '';
        foreach ($characterCount as $key => $value) {
            $generatedChecksum .= $value['character'];
            if (strlen($generatedChecksum) === 5) {
                break;
            }
        }

        return $generatedChecksum === $checksum;
    }

    public function getCharacterCount(string $roomName) : array
    {
        $count = [];
        $key = 0;
        $found = [];
        foreach (str_split($roomName) as $char) {
            if (!in_array($char, $found)) {
                $found[] = $char;
                $no = substr_count($roomName, $char);
                $count[] = ['character' => $char, 'frequency' => $no];
                $character[][$key] = $char;
                $frequency[][$key] = $no;
            }
        }
        array_multisort($frequency, SORT_DESC, $character, SORT_ASC, $count);
        return $count;
    }

    public function decode(string $rooms, bool $partTwo = false) : int
    {
        $rooms = explode(PHP_EOL, $rooms);
        $count = 0;
        foreach ($rooms as $room) {
            $split = $this->split($room);
            list($name, $sectorId, $checksum) = $split;
            if ($this->isValidRoom($name, $checksum)) {
                $count += $sectorId;
                if($partTwo && $this->decrypt($name, $sectorId) === 'northpoleobjectstorage') {
                    return $sectorId;
                }
            }
        }
        return $count;
    }

    public function decrypt(string $roomName, int $sectorId) : string
    {
        $decrypted = '';
        $roomNameCharacters = str_split($roomName);
        foreach ($roomNameCharacters as $character) {
            if($character === '-') {
                $decrypted .= ' ';
                continue;
            }
            $characterNo = ord($character);
            for ($i = 0; $i < $sectorId; $i++) {
                $characterNo++;
                if($characterNo > ord('z')) {
                    $characterNo = ord('a');
                }
            }
            $decrypted .= chr($characterNo);
        }
        return trim($decrypted);
    }
}