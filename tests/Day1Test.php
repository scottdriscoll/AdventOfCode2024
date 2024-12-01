<?php

namespace App\Tests;

use App\Solutions\Day1;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    private string $input;
    private Day1 $day1;

    protected function setUp(): void
    {
        $this->input = file_get_contents(__DIR__ . '/fixtures/day1.txt');
        $this->day1 = new Day1();
    }

    public function testPart1(): void
    {
        $this->assertSame(11, $this->day1->part1($this->input));
    }

    public function testPart2(): void
    {
        $this->assertSame(31, $this->day1->part2($this->input));
    }
}
