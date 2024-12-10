<?php

use App\Solutions\Day10;
use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    private Day10 $day10;

    protected function setUp(): void
    {
        $this->day10 = new Day10();
    }

    public function testPart1(): void
    {
        $this->assertSame(36, $this->day10->part1(file_get_contents(__DIR__ . '/fixtures/day10.txt')));
    }

    /*
    public function testPart2(): void
    {
        $this->assertSame(null, $this->day10->part2(file_get_contents(__DIR__ . '/fixtures/day10.txt')));
    }
    */
}
