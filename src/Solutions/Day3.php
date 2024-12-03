<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-3', 48)]
class Day3 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 3;
    }

    public function part1(string $input): int
    {
        $answer = 0;
        $matches = [];

        preg_match_all('/mul\(\d+,\d+\)/', $input, $matches);

        foreach ($matches[0] as $row) {
            $numbers = [];
            preg_match_all('/\d+/', $row, $numbers);

            $answer += (int) $numbers[0][0] * (int) $numbers[0][1];
        }

        return $answer;
    }

    public function part2(string $input): int
    {
        $answer = 0;
        $matches = [];
        $enabled = true;
        preg_match_all('/mul\(\d+,\d+\)|don\'t\(\)|do\(\)/', $input, $matches, PREG_PATTERN_ORDER);

        foreach ($matches[0] as $row) {
            if ($row === 'don\'t()') {
                $enabled = false;
            } elseif ($row === 'do()') {
                $enabled = true;
            } elseif ($enabled === true) {
                $numbers = [];
                preg_match_all('/\d+/', $row, $numbers);

                $answer += (int) $numbers[0][0] * (int) $numbers[0][1];
            }
        }

        return $answer;
    }
}
