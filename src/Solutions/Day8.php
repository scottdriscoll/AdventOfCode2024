<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

readonly class Point
{
    public function __construct (
        public int $x,
        public int $y,
    ) {
    }
}

#[AsTaggedItem('day-8', 43)]
class Day8 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 8;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $answer = 0;
        /** @var array<string,Point> $map */
        $map = [];
        $results = [];

        $y = 0;
        $size = 0;
        foreach (explode("\n", $input) as $line) {
            $x = 0;
            // Size is perfect square
            $line = trim($line);
            if (!$size) {
                $size = strlen($line);
            }
            foreach (str_split($line) as $char) {
                if ($char !== '.') {
                    $map[$char][] = new Point($x, $y);
                }
                $x++;
            }

            $y++;
        }

        /**
         * @var string $char
         * @var array<int, Point> $arr
         */
        foreach ($map as $char => $arr) {
            if (count($arr) === 1) {
                continue;
            }
            foreach ($arr as $idx => $point1) {
                if ($idx === count($arr) - 1) {
                    break;
                }
                $rest = [];
                for ($i = $idx + 1; $i < count($arr); $i++) {
                    $rest[] = $arr[$i];
                }

                foreach ($rest as $point2) {
                    $xDiff = abs($point1->x - $point2->x);
                    $yDiff = $point2->y - $point1->y;
                    $new1 = new Point(
                        x: ($point1->x < $point2->x) ? $point1->x - $xDiff : $point1->x + $xDiff,
                        y: $point1->y - $yDiff
                    );

                    $new2 = new Point(
                        x: ($point2->x < $point1->x) ? $point2->x - $xDiff : $point2->x + $xDiff,
                        y: $point2->y + $yDiff
                    );

                    if ($new1->x >= 0 && $new1->x < $size && $new1->y >= 0 && $new1->y < $size) {
                        $results[$new1->y][$new1->x] = true;
                    }

                    if ($new2->x >= 0 && $new2->x < $size && $new2->y >= 0 && $new2->y < $size) {
                        $results[$new2->y][$new2->x] = true;
                    }
                }
            }
        }

        foreach ($results as $y => $arr) {
            $answer += count($arr);
        }

        // 331 too high

        return $answer;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;

        return $answer;
    }
}
