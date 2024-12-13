<?php

namespace App\Tests;

use App\Solutions\Day12;
use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    private Day12 $day;

    protected function setUp(): void
    {
        $this->day = new Day12();
    }

    public function testPart1(): void
    {

        $this->assertSame(140, $this->day->part1("AAAA\nBBCD\nBBCC\nEEEC"));
        $this->assertSame(772, $this->day->part1("OOOOO\nOXOXO\nOOOOO\nOXOXO\nOOOOO"));
        $this->assertSame(1930, $this->day->part1(file_get_contents(__DIR__ . '/fixtures/day12.txt')));
    }

    public function testPart2(): void
    {
        $this->assertSame(80, $this->day->part2("AAAA\nBBCD\nBBCC\nEEEC"));
        $this->assertSame(236, $this->day->part2("EEEEE\nEXXXX\nEEEEE\nEXXXX\nEEEEE"));
        $this->assertSame(436, $this->day->part2("OOOOO\nOXOXO\nOOOOO\nOXOXO\nOOOOO"));
        $this->assertSame(368, $this->day->part2("AAAAAA\nAAABBA\nAAABBA\nABBAAA\nABBAAA\nAAAAAA"));
        $this->assertSame(1206, $this->day->part2(file_get_contents(__DIR__ . '/fixtures/day12.txt')));
    }
}
