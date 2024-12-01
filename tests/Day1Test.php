<?php

namespace App\Tests;

use App\Solutions\Day1\Part1;
use App\Solutions\Day1\Part2;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    public function testPart1(): void
    {
        $part1 = new Part1();
        $input = file_get_contents(__DIR__ . '/fixtures/day1/part1.txt');
        $this->assertSame('11', $part1->run($input));
    }

    public function testPart2(): void
    {
        $part2 = new Part2();
        $input = file_get_contents(__DIR__ . '/fixtures/day1/part2.txt');
        $this->assertSame('31', $part2->run($input));
    }
}
