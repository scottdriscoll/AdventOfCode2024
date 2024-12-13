<?php

namespace App\Tests;

use App\Solutions\Day13;
use PHPUnit\Framework\TestCase;

class Day13Test extends TestCase
{
    private Day13 $day;

    protected function setUp(): void
    {
        $this->day = new Day13();
    }

    public function testPart1(): void
    {
        $this->assertSame(480, $this->day->part1(file_get_contents(__DIR__ . '/fixtures/day13.txt')));
    }

    /*
    public function testPart2(): void
    {
        $this->assertSame(null, $this->day->part2(file_get_contents(__DIR__ . '/fixtures/day13.txt')));
    }
    */
}
