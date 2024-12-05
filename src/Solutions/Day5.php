<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-5', 46)]
class Day5 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 5;
    }

    public function part1(string $input): int
    {
        $answer = 0;
        $orders = [];
        $lines = [];

        $parts = explode("\n\n", $input);
        foreach (explode("\n", $parts[0]) as $part) {
            $numbers = explode("|", $part);
            $orders[] = [(int) $numbers[0], (int) $numbers[1]];
        }

        foreach (explode("\n", $parts[1]) as $part) {
            $arr = explode(',', $part);
            $input = [];
            foreach ($arr as $val) {
                $input[] = (int) $val;

            }
            $lines[] = ['valid' => true, 'numbers' => $input];
        }

        foreach ($orders as $order) {
            foreach ($lines as &$line) {
                if ($line['valid'] && !$this->isSorted($line['numbers'], $order)) {
                    $line['valid'] = false;
                }
            }
            unset($line);
        }

        foreach ($lines as $line) {
            if ($line['valid']) {
                $idx = floor(count($line['numbers']) / 2);
                $answer += $line['numbers'][$idx];
            }
        }

        return $answer;
    }

    private function isSorted(array $search, array $input): bool
    {
        $index = 0;
        $first = -1;
        $second = -1;

        foreach ($search as $val) {
            if ($val === $input[0]) {
                $first = $index++;
            } elseif ($val === $input[1]) {
                $second = $index++;
            }
        }

        return ($first < $second) || ($first === -1 || $second === -1);
    }

    public function part2(string $input): int
    {
        $answer = 0;

        return $answer;
    }
}
