<?php

namespace App\Tests;

use App\Solutions\Day3;
use PHPUnit\Framework\TestCase;

class Day3Test extends TestCase
{
    private string $input;
    private Day3 $day3;

    protected function setUp(): void
    {
        $this->input = file_get_contents(__DIR__ . '/fixtures/day3.txt');
        $this->day3 = new Day3();
    }

    public function testPart1(): void
    {
        $this->assertSame(161, $this->day3->part1($this->input));
    }

    public function testPart2(): void
    {
        $this->assertSame(0, $this->day3->part2($this->input));
    }
}
