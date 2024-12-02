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
            if ($this->isRowSafe($values)) {
                $answer++;
            }
        }

        return $answer;
    }

    public function part2(string $input): int
    {
        $answer = 0;
        foreach (explode("\n", $input) as $row) {
            $values = explode(" ", $row);
            if ($this->isRowSafe($values)) {
                $answer++;
                continue;
            }

            $count = count($values);
            for ($i = 0; $i < $count; $i++) {
                $temp = $values;
                array_splice($temp, $i, 1);
                if ($this->isRowSafe($temp)) {
                    $answer++;
                    continue 2;
                }
            }
        }

        return $answer;
    }

    private function isRowSafe(array $values): bool
    {
        $count = count($values);
        $increasing = $values[1] > $values[0];
        for ($i = 1; $i < $count; $i++) {
            if (!$this->isSafe($values[$i], $values[$i - 1], $increasing)) {
                return false;
            }
        }

        return true;
    }

    private function isSafe(int $a, int $b, bool $increasing): bool
    {
        if (($increasing && $a <= $b) || (!$increasing && $a >= $b)) {
            return false;
        }

        $diff = abs($a - $b);

        return $diff >= self::MIN_OFFSET && $diff <= self::MAX_OFFSET;
    }
}
