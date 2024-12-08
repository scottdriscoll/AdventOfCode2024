<?php


use App\Solutions\Day8;
use PHPUnit\Framework\TestCase;

class Day8Test extends TestCase
{
    private Day8 $day8;

    protected function setUp(): void
    {
        $this->day8 = new Day8();
    }

    public function testPart1(): void
    {
        $this->assertSame(14, $this->day8->part1(file_get_contents(__DIR__ . '/fixtures/day8.txt')));
    }

    public function testPart2(): void
    {
        $this->assertSame(34, $this->day8->part2(file_get_contents(__DIR__ . '/fixtures/day8.txt')));
    }
}
