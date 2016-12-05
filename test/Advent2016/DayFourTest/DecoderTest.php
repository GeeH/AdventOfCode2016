<?php
/**
 * Created by PhpStorm.
 * User: GeeH
 * Date: 04/12/2016
 * Time: 12:50
 */

namespace Advent2016\DayFourTest;


use Advent2016\DayFour\Decoder;


class DecoderTest extends \PHPUnit_Framework_TestCase
{
    private $rooms = <<<ROOMS
aaaaa-bbb-z-y-x-123[abxyz]
a-b-c-d-e-f-g-h-987[abcde]
not-a-real-room-404[oarel]
totally-real-room-200[decoy]
ROOMS;
    /**
     * @var Decoder
     */
    private $decoder;

    public function setUp()
    {
        $this->decoder = new Decoder();
    }

    public function testExamplesPass()
    {
        self::assertEquals(1514, $this->decoder->decode($this->rooms));
    }

    public function testRoomSplitsCorrectly()
    {
        $room = 'aaaaa-bbb-z-y-x-123[abxyz]';
        self::assertEquals([
            'aaaaabbbzyx',
            '123',
            'abxyz'
        ], $this->decoder->split($room));
    }

    public function testStringCharCount()
    {
        $room = 'aaaaabbbzxy';
        $decodedRoom = [
            ['character' => 'a', 'frequency' => 5],
            ['character' => 'b', 'frequency' => 3],
            ['character' => 'x', 'frequency' => 1],
            ['character' => 'y', 'frequency' => 1],
            ['character' => 'z', 'frequency' => 1],
        ];
        self::assertEquals($decodedRoom, $this->decoder->getCharacterCount($room));

        $room = 'notarealroom';
        $result = [
            ['character' => 'o', 'frequency' => 3],
            ['character' => 'a', 'frequency' => 2],
            ['character' => 'r', 'frequency' => 2],
            ['character' => 'e', 'frequency' => 1],
            ['character' => 'l', 'frequency' => 1],
            ['character' => 'm', 'frequency' => 1],
            ['character' => 'n', 'frequency' => 1],
            ['character' => 't', 'frequency' => 1],
        ];

        self::assertEquals($result, $this->decoder->getCharacterCount($room));
    }

    public function testRoomIsValid()
    {
        $room = 'aaaaa-bbb-z-y-x-123[abxyz]';
        $decoded = $this->decoder->split($room);
        self::assertTrue($this->decoder->isValidRoom($decoded[0], $decoded[2]));
    }

    public function testRoomIsInvalid()
    {
        $room = 'totally-real-room-200[decoy]';
        $decoded = $this->decoder->split($room);
        self::assertFalse($this->decoder->isValidRoom($decoded[0], $decoded[2]));
    }

    public function testCodeCanBeDecrypted()
    {
        $room = 'qzmt-zixmtkozy-ivhz-343[check]';
        $decrypted = 'very encrypted name';

        $decoded = $this->decoder->split($room, false);
        self::assertEquals($decrypted, $this->decoder->decrypt($decoded[0], $decoded[1]));
    }
}
