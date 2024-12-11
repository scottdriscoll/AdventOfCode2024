<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-11', 40)]
class Day11 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 11;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        return $this->doWork($input, 25);
    }

    public function part2(string $input, bool $visualize = false): int
    {
        return $this->doWork($input, 75);
    }

    private function doWork(string $input, int $count): int
    {
        $stones = [];
        foreach (explode(' ', $input) as $val) {
            $val = (int) $val;
            $stones[$val] = (isset($stones[$val]) ? $stones[$val] + 1 : 1);
        }

        for ($i = 0; $i < $count; $i++) {
            foreach ($stones as $stoneValue => $stoneCount) {
                if ($stoneCount === 0) {
                    continue;
                }

                if ($stoneValue === 0) {
                    $stones[1] = isset($stones[1]) ? $stones[1] + $stoneCount : $stoneCount;
                } elseif (strlen((string)$stoneValue) % 2 === 0) {
                    $str = (string) $stoneValue;
                    $len = strlen($str) / 2;
                    $val1 = (int) substr($str, 0, $len);
                    $val2 = (int) substr($str, $len);
                    $stones[$val1] = isset($stones[$val1]) ? $stones[$val1] + $stoneCount : $stoneCount;
                    $stones[$val2] = isset($stones[$val2]) ? $stones[$val2] + $stoneCount : $stoneCount;
                } else {
                    $newValue = $stoneValue * 2024;
                    $stones[$newValue] = isset($stones[$newValue]) ? $stones[$newValue] + $stoneCount : $stoneCount;
                }

                $stones[$stoneValue] -= $stoneCount;
            }
        }

        return array_sum($stones);
    }
}
