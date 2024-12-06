<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

enum Direction
{
    case North;
    case East;
    case South;
    case West;
    case Exit;
}

class Player
{
    public function __construct(
        public int $x = -1,
        public int $y = 0,
        public Direction $direction = Direction::North,
    ) {
    }
}

#[AsTaggedItem('day-6', 45)]
class Day6 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 6;
    }

    public function part1(string $input): int
    {
        $answer = 0;
        $player = new Player();
        $grid = [];
        $visited = [];

        foreach (explode("\n", $input) as $line) {
            $row = str_split($line);
            if ($player->x === -1) {
                $pos = strpos($line, '^');
                if ($pos !== false) {
                    // Player starting position is now at x,y
                    $player->x = $pos;
                    $row[$player->x] = '.';
                } else {
                    $player->y++;
                }
            }

            $grid[] = $row;
        }

        // Board is a perfect square
        $size = count($grid[0]);
        $visited[$player->y][$player->x] = true;

        while (true) {
            $this->updatePlayerPosition($player, $grid, $size);
            if ($player->direction === Direction::Exit) {
                break;
            }

            $visited[$player->y][$player->x] = true;
        }

        foreach ($visited as $arr) {
            $answer += count($arr);
        }

        return $answer;
    }

    private function updatePlayerPosition(Player $player, array $grid, int $size): void
    {
        if ($player->direction === Direction::North) {
            if ($player->y - 1 < 0) {
                $player->direction = Direction::Exit;
            } elseif ($grid[$player->y - 1][$player->x] === '#') {
                $player->direction = Direction::East;
            } else {
                $player->y--;
            }

            return;
        }

        if ($player->direction === Direction::South) {
            if ($player->y + 1 === $size) {
                $player->direction = Direction::Exit;
            } elseif ($grid[$player->y + 1][$player->x] === '#') {
                $player->direction = Direction::West;
            } else {
                $player->y++;
            }

            return;
        }
        if ($player->direction === Direction::West) {
            if ($player->x - 1 < 0) {
                $player->direction = Direction::Exit;
            } elseif ($grid[$player->y][$player->x - 1] === '#') {
                $player->direction = Direction::North;
            } else {
                $player->x--;
            }

            return;
        }

        if ($player->direction === Direction::East) {
            if ($player->x + 1 === $size) {
                $player->direction = Direction::Exit;
            } elseif ($grid[$player->y][$player->x + 1] === '#') {
                $player->direction = Direction::South;
            } else {
                $player->x++;
            }
        }
    }

    public function part2(string $input): int
    {
        $answer = 0;

        return $answer;
    }
}
