<?php


use App\Solutions\Day5;
use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    private Day5 $day5;

    protected function setUp(): void
    {
        $this->day5 = new Day5();
    }

    public function testPart1(): void
    {
        $this->assertSame(143, $this->day5->part1(file_get_contents(__DIR__ . '/fixtures/day5.txt')));
    }

    /*
    public function testPart2(): void
    {
        $this->assertSame(0, $this->day5->part2(file_get_contents(__DIR__ . '/fixtures/day5.txt')));
    }
    */
}
