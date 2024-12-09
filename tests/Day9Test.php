<?php


use App\Solutions\Day9;
use PHPUnit\Framework\TestCase;

class Day9Test extends TestCase
{
    private Day9 $day9;

    protected function setUp(): void
    {
        $this->day9 = new Day9();
    }

    public function testPart1(): void
    {
        $this->assertSame(60, $this->day9->part1('12345'));
        $this->assertSame(1928, $this->day9->part1('2333133121414131402'));
    }

    public function testPart2(): void
    {
        $this->assertSame(2858, $this->day9->part2('2333133121414131402'));
    }
}
