<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-9', 42)]
class Day9 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 9;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $ids = [];
        $id = 0;
        $parsingId = true;
        foreach (str_split(trim($input)) as $digit) {
            $digit = (int) $digit;
            if ($parsingId) {
                for ($i = 0; $i < $digit; $i++) {
                    $ids[] = $id;
                }

                $id++;
            } else {
                for ($i = 0; $i < $digit; $i++) {
                    $ids[] = null;
                }
            }

            $parsingId = !$parsingId;
        }

        // now, swap first most null with last most non-null. repeat for all
        $start = 0;
        $end = count($ids) - 1;

        while (true) {
            while ($ids[$start] !== null) {
                $start++;
            }
            while ($ids[$end] === null) {
                $end--;
            }

            if ($start >= $end) {
                break;
            }

            $tmp = $ids[$end];
            $ids[$end] = $ids[$start];
            $ids[$start] = $tmp;
        }

        // Calculate checksum
        $i = 0;
        while ($ids[$i++] !== null) {
            $answer += $i * $ids[$i];
        }

        return $answer;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;

        return $answer;
    }
}
