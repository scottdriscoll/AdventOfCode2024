<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-12', 39)]
class Day12 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 12;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $parsed = $this->parseInput($input);
        $grid = $parsed['grid'];
        $size = $parsed['size'];
        $visited = [];
        $regions = [];
        $regionCount = 0;
        for ($i = 0; $i < $size; $i++) {
            $visited[$i] = array_fill(0, $size, false);
        }

        for ($x = 0; $x < $size; $x++) {
            for ($y = 0; $y < $size; $y++) {
                $this->traverse($grid, $visited, $regions, $x, $y, $size, null, $regionCount);
            }
        }

        // Calculate costs
        $total = 0;
        foreach ($regions as $region) {
            $total += $region['area'] * $region['perimeter'];
        }

        return $total;
    }

    private function traverse(array &$grid, array &$visited, array &$regions, int $x, int $y, int $size, ?int $currentRegionId, int &$regionCount): void
    {
        if ($visited[$y][$x]) {
            return;
        }

        if ($currentRegionId === null) {
            $currentRegionId = $regionCount++;
        }

        $visited[$y][$x] = true;
        if (!isset($regions[$currentRegionId])) {
            $regions[$currentRegionId] = [
                'area' => 1,
                'plot' => $grid[$y][$x],
                'perimeter' => 0,
            ];
        } else {
            $regions[$currentRegionId]['area']++;
        }

        // check all 4 directions. If we cannot move, increase perimeter. Otherwise, recursively go there.

        // Try right
        if ($x < $size - 1 && $grid[$y][$x + 1] === $grid[$y][$x]) {
            $this->traverse($grid, $visited, $regions, $x + 1, $y, $size, $currentRegionId, $regionCount);
        } else {
            $regions[$currentRegionId]['perimeter']++;
        }

        // Try up
        if ($y > 0 && $grid[$y - 1][$x] === $grid[$y][$x]) {
            $this->traverse($grid, $visited, $regions, $x, $y - 1, $size, $currentRegionId, $regionCount);
        } else {
            $regions[$currentRegionId]['perimeter']++;
        }

        // Try down
        if ($y < $size - 1 && $grid[$y + 1][$x] === $grid[$y][$x]) {
            $this->traverse($grid, $visited, $regions, $x, $y + 1, $size, $currentRegionId, $regionCount);
        } else {
            $regions[$currentRegionId]['perimeter']++;
        }

        // Try left
        if ($x > 0 && $grid[$y][$x - 1] === $grid[$y][$x]) {
            $this->traverse($grid, $visited, $regions, $x - 1, $y, $size, $currentRegionId, $regionCount);
        } else {
            $regions[$currentRegionId]['perimeter']++;
        }
    }

    public function part2(string $input, bool $visualize = false): int
    {
        return 0;
    }

    private function parseInput(string $input): array
    {
        $grid = [];
        foreach (explode("\n", $input) as $line) {
            $grid[] = str_split($line);
        }

        return [
            'grid' => $grid,
            'size' => count($grid[0]),
        ];
    }
}
