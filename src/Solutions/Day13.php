<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-13', 38)]
class Day13 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 13;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $total = 0;
        foreach ($this->parseInput($input) as $group) {
            $total += $this->solve($group['ax'], $group['ay'], $group['bx'], $group['by'], $group['px'], $group['py'], 0);
        }

        return $total;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $total = 0;
        foreach ($this->parseInput($input) as $group) {
            $total += $this->solve($group['ax'], $group['ay'], $group['bx'], $group['by'], $group['px'], $group['py'], 10000000000000);
        }

        return $total;
    }

    private function solve(int $ax, int $ay, int $bx, int $by, int $px, int $py, int $shift): int
    {
        $px += $shift;
        $py += $shift;
        $a = ($py * $bx - $px * $by) / ($ay * $bx - $ax * $by);
        $b = -(($py * $ax - $px * $ay) / ($ay * $bx - $ax * $by));

        if (is_int($a) && is_int($b)) {
            return $a * 3 + $b;
        }

        return 0;
    }

    private function parseInput(string $input): array
    {
        $arr = [];

        foreach (explode("\n\n", $input) as $group) {
            $rows = explode("\n", $group);
            $buttonA = [];
            $buttonB = [];
            $prize = [];

            preg_match_all('/\d+/', $rows[0], $buttonA);
            preg_match_all('/\d+/', $rows[1], $buttonB);
            preg_match_all('/\d+/', $rows[2], $prize);

            $arr[] = [
                'ax' => (int) $buttonA[0][0],
                'ay' => (int) $buttonA[0][1],
                'bx' => (int) $buttonB[0][0],
                'by' => (int) $buttonB[0][1],
                'px' => (int) $prize[0][0],
                'py' => (int) $prize[0][1],
            ];
        }

        return $arr;
    }
}
