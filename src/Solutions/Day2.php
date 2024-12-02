<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-2', 49)]
class Day2 implements SolutionInterface
{
    const int MIN_OFFSET = 1;
    const int MAX_OFFSET = 3;

    public static function getDay(): int
    {
        return 2;
    }

    public function part1(string $input): int
    {
        $answer = 0;
        foreach (explode("\n", $input) as $row) {
            $values = explode(" ", $row);
            $count = count($values);
            $valid = true;
            $increasing = $values[1] > $values[0];
            for ($i = 1; $i < $count && $valid; $i++) {
                $diff = abs($values[$i] - $values[$i - 1]);
                if ($diff < self::MIN_OFFSET || $diff > self::MAX_OFFSET) {
                    $valid = false;
                } elseif ($increasing && $values[$i] <= $values[$i - 1]) {
                    $valid = false;
                } elseif (!$increasing && $values[$i] >= $values[$i - 1]) {
                    $valid = false;
                }
            }

            if ($valid) {
                $answer++;
            }
        }

        return $answer;
    }

    public function part2(string $input): int
    {
        return 0;
    }
}
