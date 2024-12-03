<?php

namespace App\Tests;

use App\Solutions\Day3;
use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    private Day3 $day3;

    protected function setUp(): void
    {
        $this->day3 = new Day3();
    }

    public function testPart1(): void
    {
        $this->assertSame(161, $this->day3->part1(file_get_contents(__DIR__ . '/fixtures/day3.txt')));
    }

    public function testPart2(): void
    {
        $this->assertSame(48, $this->day3->part2(file_get_contents(__DIR__ . '/fixtures/day3_part2.txt')));
    }
}
