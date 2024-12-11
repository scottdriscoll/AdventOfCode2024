<?php

namespace App\Tests;

use App\Solutions\Day11;
use PHPUnit\Framework\TestCase;

class Day11Test extends TestCase
{
    private Day11 $day11;

    protected function setUp(): void
    {
        $this->day11 = new Day11();
    }

    public function testPart1(): void
    {
        $this->assertSame(55312, $this->day11->part1('125 17'));
    }

    public function testPart2(): void
    {
        $this->assertSame(65601038650482, $this->day11->part2('125 17'));
    }
}
