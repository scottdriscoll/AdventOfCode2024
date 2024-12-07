<?php


use App\Solutions\Day7;
use PHPUnit\Framework\TestCase;

class Day7Test extends TestCase
{
    private Day7 $day7;

    protected function setUp(): void
    {
        $this->day7 = new Day7();
    }

    public function testPart1(): void
    {
        $this->assertSame(3749, $this->day7->part1(file_get_contents(__DIR__ . '/fixtures/day7.txt')));
    }

    public function testPart2(): void
    {
        $this->assertSame(11387, $this->day7->part2(file_get_contents(__DIR__ . '/fixtures/day7.txt')));
    }
}
