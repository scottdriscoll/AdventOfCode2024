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

        $this->loadBoard($player, $grid, $input);

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

    private function loadBoard(Player $player, array &$grid, string $input)
    {
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
        $player = new Player();
        $grid = [];

        $this->loadBoard($player, $grid, $input);
        $size = count($grid[0]);

        // Save starting location, we're going to brute force this thing
        $startX = $player->x;
        $startY = $player->y;

        // Loop through all cells, looking for a '.', and not the players current position
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($grid[$y][$x] === '.' && ($y !== $startY || $x !== $startX)) {
                    // Reset player
                    $player->y = $startY;
                    $player->x = $startX;
                    $player->direction = Direction::North;
                    $visited = [];

                    // Place obstacle
                    $grid[$y][$x] = '#';

                    $break = 0;
                    while (true) {
                        if ($break++ === 135250) {
                            var_dump($visited[$player->y]);
                            var_dump($player);
                            echo "\nHit loop limit on $y, $x\n";
                            exit;
                        }

                        $this->updatePlayerPosition($player, $grid, $size);
                        if ($player->direction === Direction::Exit) {
                            break;
                        }

                        // check for a loop
                        if (isset($visited[$player->y][$player->x][$player->direction->name]) && $visited[$player->y][$player->x][$player->direction->name] === true) {
                            $answer++;
                            break;
                        }
                        $visited[$player->y][$player->x][$player->direction->name] = true;
                    }

                    // remove obstacle
                    $grid[$y][$x] = '.';
                }
            }
        }

        return $answer;
    }
}
