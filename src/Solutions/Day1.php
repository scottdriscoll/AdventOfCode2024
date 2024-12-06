<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-1', 50)]
class Day1 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 1;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $firstArray = [];
        $secondArray = [];
        $answer = 0;

        foreach (explode("\n", $input) as $line) {
            sscanf($line, "%d   %d", $first, $second);
            $firstArray[] = $first;
            $secondArray[] = $second;
        }

        sort($firstArray);
        sort($secondArray);

        $total = count($firstArray);
        for ($i = 0; $i < $total; $i++) {
            $answer += abs($firstArray[$i] - $secondArray[$i]);
        }

        return $answer;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $firstArray = [];
        $secondArray = [];
        $answer = 0;

        foreach (explode("\n", $input) as $line) {
            sscanf($line, "%d   %d", $first, $second);
            $firstArray[] = $first;
            $secondArray[$second] = isset($secondArray[$second]) ? $secondArray[$second] + 1 : 1;
        }

        foreach ($firstArray as $val) {
            if (isset($secondArray[$val])) {
                $answer += $val * $secondArray[$val];
            }
        }

        return $answer;
    }
}
