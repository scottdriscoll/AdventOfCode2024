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

    /*
    public function testPart2(): void
    {
        $this->assertSame(null, $this->day->part1(file_get_contents(__DIR__ . '/fixtures/day12.txt')));
    }
    */
}
