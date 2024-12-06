<?php


use App\Solutions\Day6;
use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    private Day6 $day6;

    protected function setUp(): void
    {
        $this->day6 = new Day6();
    }

    public function testPart1(): void
    {
        $this->assertSame(41, $this->day6->part1(file_get_contents(__DIR__ . '/fixtures/day6.txt')));
    }

    /*
    public function testPart2(): void
    {
        $this->assertSame(null, $this->day6->part2(file_get_contents(__DIR__ . '/fixtures/day6.txt')));
    }
    */
}
