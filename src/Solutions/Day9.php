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
        $ids = $this->parseInput($input);

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

        return $this->calculateChecksum($ids);
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $ids = $this->parseInput($input);
        $totalSlots = count($ids);
        $sizes = [];
        // figure out sizes of file blocks
        foreach ($ids as $id) {
            if ($id) {
                $sizes[$id] = isset($sizes[$id]) ? $sizes[$id] + 1 : 1;
            }
        }
        $sizes = array_reverse($sizes, true);

        foreach ($sizes as $id => $count) {
            $gapIndex = $this->findGapOfSize($ids, $count);
            if (!$gapIndex) {
                continue;
            }

            // find starting index of current id
            for ($idIndex = 0; $idIndex < $totalSlots && $ids[$idIndex] !== $id; $idIndex++) {}
            if ($gapIndex >= $idIndex) {
                continue;
            }

            for ($i = 0; $i < $count; $i++) {
                $ids[$gapIndex + $i] = $id;
            }

            for ($i = 0; $i < $count; $i++) {
                $ids[$idIndex + $i] = null;
            }
        }

        return $this->calculateChecksum($ids);
    }


    private function findGapOfSize(array $ids, int $sizeRequested): ?int
    {
        for ($i = 0, $max = count($ids); $i < $max; $i++) {
            if ($ids[$i] === null) {
                $gapIndex = $i;
                for ($j = $i, $size = 0; $j < $max && $ids[$j] === null; $j++, $size++) {}

                if ($size >= $sizeRequested) {
                    return $gapIndex;
                }
            }
        }

        return null;
    }

    private function calculateChecksum(array $ids): int{
        $total = 0;
        for ($i = 0, $iMax = count($ids); $i < $iMax; $i++) {
            if ($ids[$i] !== null) {
                $total += $i * $ids[$i];
            }
        }

        return $total;
    }

    private function parseInput(string $input): array
    {
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

        return $ids;
    }
}
