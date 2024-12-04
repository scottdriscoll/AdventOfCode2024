<?php


use App\Solutions\Day4;
use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    private Day4 $day4;

    protected function setUp(): void
    {
        $this->day4 = new Day4();
    }

    public function testPart1(): void
    {
        $this->assertSame(18, $this->day4->part1(file_get_contents(__DIR__ . '/fixtures/day4.txt')));
    }

    /*
    public function testPart2(): void
    {
        $this->assertSame(0, $this->day4->part2(file_get_contents(__DIR__ . '/fixtures/day3_part2.txt')));
    }
    */
}
