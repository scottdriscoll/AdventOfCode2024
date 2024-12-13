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
        $regions = $this->getRegions($input)['regions'];

        // Calculate costs
        $total = 0;
        foreach ($regions as $region) {
            $total += $region['area'] * $region['perimeter'];
        }

        return $total;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $arr = $this->getRegions($input);
        $regions = $arr['regions'];
        $size = $arr['size'];
        $totalArea = 0;

        /**
         * AAAA   AAAA   BABB  BBABB  AAAABAA
         * BBCD   BABB   BABB  AAAAA  AABAAAA
         * BBCC          BABB  BBABB  BBBABBB
         * EEEC          BABB  BBABB
         */
        // Need to search for distinct edges
        foreach ($regions as $region) {
            // Group into lines
            $topLines = [];
            $bottomLines = [];
            $leftLines = [];
            $rightLines = [];
            foreach ($region['map'] as $y => $line) {
                foreach ($line as $x => $true) {
                    $y1 = $y+1;
                    $x1 = $x+1;
                    $topLines[] = "$y|$x";
                    $bottomLines[] = "$y1|$x";
                    $leftLines[] = "$y|$x";
                    $rightLines[] = "$y|$x1";
                }
            }

            // Remove duplicates
            $bottom = array_diff($bottomLines, $topLines);
            $top = array_diff($topLines, $bottomLines);
            $right = array_diff($rightLines, $leftLines);
            $left = array_diff($leftLines, $rightLines);

            $lines = 0;
            for ($y = 0; $y <= $size; $y++) {
                for ($x = 0; $x <= $size; $x++) {
                    $leftX = $x - 1;
                    $topY = $y - 1;
                    if (in_array("$y|$x", $top) && !in_array("$y|$leftX", $top)) {
                        $lines++;
                    }

                    if (in_array("$y|$x", $bottom) && !in_array("$y|$leftX", $bottom)) {
                        $lines++;
                    }

                    if (in_array("$y|$x", $left) && !in_array("$topY|$x", $left)) {
                        $lines++;
                    }

                    if (in_array("$y|$x", $right) && !in_array("$topY|$x", $right)) {
                        $lines++;
                    }
                }
            }

            $totalArea += ($region['area'] * $lines);
        }

        return $totalArea;
    }

    private function traverse(array &$grid, array &$visited, array &$regions, int $x, int $y, int $size, ?int &$currentRegionId, int &$regionCount): void
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
                'map' => [],
            ];
        } else {
            $regions[$currentRegionId]['area']++;
        }

        $regions[$currentRegionId]['map'][$y][$x] = true;

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

    private function canMove(array $grid, int $currentX, int $currentY, int $newX, int $newY): bool
    {
        return isset($grid[$newY][$newX]) && $grid[$newY][$newX] === $grid[$currentY][$currentX];
    }

    private function getRegions(string $input): array
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
                $regionId = null;
                $this->traverse($grid, $visited, $regions, $x, $y, $size, $regionId, $regionCount);
            }
        }

        return [
            'regions' => $regions,
            'size' => $size,
        ];
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
