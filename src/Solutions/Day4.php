<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-4', 47)]
class Day4 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 4;
    }

    public function part1(string $input): int
    {
        $answer = 0;
        $words = [];
        foreach (explode("\n", $input) as $line) {
            $words[] = str_split($line);
        }

        // Fortunately, input is a perfect square.
        $size = count($words[0]);

        // Let's look for every X and just search around it
        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                if ($words[$row][$col] !== 'X') {
                    continue;
                }

                $answer += $this->getCount($col, $row, $size, $words);
            }
        }

        return $answer;
    }

    private function getCount(int $col, int $row, int $size, array $words): int
    {
        $count = 0;

        // Search left
        if ($col + 3 < $size && $words[$row][$col+1] === 'M' && $words[$row][$col+2] === 'A' && $words[$row][$col+3] === 'S') {
            $count++;
        }

        // Search right
        if ($col - 3 >= 0 && $words[$row][$col-1] === 'M' && $words[$row][$col-2] === 'A' && $words[$row][$col-3] === 'S') {
            $count++;
        }

        // Search down
        if ($row + 3 < $size && $words[$row+1][$col] === 'M' && $words[$row+2][$col] === 'A' && $words[$row+3][$col] === 'S') {
            $count++;
        }

        // Search up
        if ($row - 3 >= 0 && $words[$row-1][$col] === 'M' && $words[$row-2][$col] === 'A' && $words[$row-3][$col] === 'S') {
            $count++;
        }

        // Search top right
        if ($row - 3 >= 0 && $col + 3 < $size && $words[$row-1][$col+1] === 'M' && $words[$row-2][$col+2] === 'A' && $words[$row-3][$col+3] === 'S') {
            $count++;
        }

        // Search bottom right
        if ($row + 3 < $size && $col + 3 < $size && $words[$row+1][$col+1] === 'M' && $words[$row+2][$col+2] === 'A' && $words[$row+3][$col+3] === 'S') {
            $count++;
        }

        // Search top left
        if ($row - 3 >= 0 && $col - 3 >= 0 && $words[$row-1][$col-1] === 'M' && $words[$row-2][$col-2] === 'A' && $words[$row-3][$col-3] === 'S') {
            $count++;
        }

        // Search bottom left
        if ($row + 3 < $size && $col - 3 >= 0 && $words[$row+1][$col-1] === 'M' && $words[$row+2][$col-2] === 'A' && $words[$row+3][$col-3] === 'S') {
            $count++;
        }

        return $count;
    }

    public function part2(string $input): int
    {
        $answer = 0;

        return $answer;
    }

    private function getXmasCount(string $input): int
    {
        $total = 0;
        $pos = 0;
        $len = strlen($input);

        while (true) {
            $offset = strpos($input, 'XMAS', $pos);
            if ($offset !== false) {
                $total++;
                $pos += $offset + 4;
                if ($pos >= $len) {
                    break;
                }
            } else {
                break;
            }
        }

        return $total;
    }
}
