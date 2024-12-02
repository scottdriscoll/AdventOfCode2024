<?php

namespace App\Tests;

use App\Solutions\Day2;
use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{
    private string $input;
    private Day2 $day2;

    protected function setUp(): void
    {
        $this->input = file_get_contents(__DIR__ . '/fixtures/day2.txt');
        $this->day2 = new Day2();
    }

    public function testPart1(): void
    {
        $this->assertSame(2, $this->day2->part1($this->input));
    }

    /*
    public function testPart2(): void
    {
//        $this->assertSame(31, $this->day2->part2($this->input));
    }
    */
}
