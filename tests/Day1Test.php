<?php

namespace App\Tests;

use App\Solutions\Day1\Part1;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    public function testPart1(): void
    {
        $part1 = new Part1();
        $input = file_get_contents(__DIR__ . '/fixtures/day1/part1.txt');
        $this->assertSame('11', $part1->run($input));
    }
}
