<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-10', 41)]
class Day10 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 10;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $grid = $this->parseInput($input);
        $size = count($grid);

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                if ($grid[$y][$x] === 0) {
                    $found = [];
                    $answer += $this->traverse($grid, $x, $y, $size, 0, $found, true);
                }
            }
        }

        return $answer;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $grid = $this->parseInput($input);
        $size = count($grid);

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                if ($grid[$y][$x] === 0) {
                    $found = [];
                    $answer += $this->traverse($grid, $x, $y, $size, 0, $found, false);
                }
            }
        }

        return $answer;
    }

    private function traverse(array $grid, int $x, int $y, int $size, int $currentValue, array &$found, bool $track): int
    {
        if ($currentValue === 9) {
            if ($track && isset($found[$y][$x])) {
                return 0;
            }

            $found[$y][$x] = true;

            return 1;
        }

        $total = 0;
        $nextVal = $currentValue + 1;
        if ($x > 0 && $grid[$y][$x - 1] === $nextVal) {
            $total += $this->traverse($grid, $x - 1, $y, $size, $nextVal, $found, $track);
        }

        if ($x < $size - 1 && $grid[$y][$x + 1] === $nextVal) {
            $total += $this->traverse($grid, $x + 1, $y, $size, $nextVal, $found, $track);
        }

        if ($y > 0 && $grid[$y - 1][$x] === $nextVal) {
            $total += $this->traverse($grid, $x, $y - 1, $size, $nextVal, $found, $track);
        }

        if ($y < $size - 1 && $grid[$y + 1][$x] === $nextVal) {
            $total += $this->traverse($grid, $x, $y + 1, $size, $nextVal, $found, $track);
        }

        return $total;
    }

    private function parseInput(string $input): array
    {
        $grid = [];

        foreach (explode("\n", $input) as $line) {
            $arr = [];
            foreach (str_split(trim($line)) as $val) {
                $arr[] = (int) $val;
            }
            $grid[] = $arr;
        }

        return $grid;
    }
}
