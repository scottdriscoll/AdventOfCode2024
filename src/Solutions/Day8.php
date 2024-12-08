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
        $results = [];
        $input = $this->parseInput($input);
        $map = $input['map'];
        $size = $input['size'];

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
                    $pointDiff = $point1->x < $point2->x ? $xDiff * -1 : $xDiff;
                    $new1 = new Point(
                        x: $point1->x + $pointDiff,
                        y: $point1->y - $yDiff
                    );

                    $pointDiff = $point2->x < $point1->x ? $xDiff * -1 : $xDiff;
                    $new2 = new Point(
                        x: $point2-> x + $pointDiff,
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

        return $answer;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $results = [];
        $input = $this->parseInput($input);
        $map = $input['map'];
        $size = $input['size'];

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
                    $results[$point1->y][$point1->x] = true;
                    $results[$point2->y][$point2->x] = true;

                    $xDiff = abs($point1->x - $point2->x);
                    $yDiff = $point2->y - $point1->y;

                    // check first point
                    $x = $point1->x;
                    $y = $point1->y;
                    $pointDiff = $point1->x < $point2->x ? $xDiff * -1 : $xDiff;
                    while (true) {
                        $x += $pointDiff;
                        $y -= $yDiff;

                        if ($x < 0 || $y < 0 || $x >= $size || $y >= $size) {
                            break;
                        }
                        $results[$y][$x] = true;
                    }

                    // check second point
                    $x = $point2->x;
                    $y = $point2->y;
                    $pointDiff = $point2->x < $point1->x ? $xDiff * -1 : $xDiff;
                    while (true) {
                        $x += $pointDiff;
                        $y += $yDiff;

                        if ($x < 0 || $y < 0 || $x >= $size || $y >= $size) {
                            break;
                        }
                        $results[$y][$x] = true;
                    }
                }
            }
        }

        foreach ($results as $y => $arr) {
            $answer += count($arr);
        }

        return $answer;
    }

    private function parseInput(string $input): array
    {
        /** @var array<string,Point> $map */
        $map = [];
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

        return [
            'map' => $map,
            'size' => $size,
        ];
    }
}
