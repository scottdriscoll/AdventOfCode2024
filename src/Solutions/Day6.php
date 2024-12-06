<?php

namespace App\Solutions;

use Intervention\Image\Geometry\Factories\RectangleFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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

    public function part1(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $player = new Player();
        $grid = [];
        $visited = [];

        $this->loadBoard($player, $grid, $input);

        // Board is a perfect square
        $size = count($grid[0]);
        $visited[$player->y][$player->x] = true;

        if ($visualize) {
            $boardSize = $size * 2;
            $manager = new ImageManager(Driver::class);
            $sourceImage = $manager->create($boardSize, $boardSize)->fill('ccc');
            $gridSize = 2;
            foreach ($grid as $y => $cols) {
                foreach ($cols as $x => $stuff) {
                    if ($grid[$y][$x] === '#') {
                        $sourceImage->drawRectangle($x * $gridSize, $y * $gridSize, function (RectangleFactory $rectangle) use ($gridSize) {
                            $rectangle->size($gridSize, $gridSize);
                            $rectangle->background('black');
                        });
                    }
                }
            }

            $imageCounter = 0;
            $image = clone $sourceImage;
            $image->drawRectangle($player->x * $gridSize, $player->y * $gridSize, function (RectangleFactory $rectangle) use ($gridSize) {
                $rectangle->size($gridSize, $gridSize);
                $rectangle->background('red');
            });
            $image->save("/tmp/images/image$imageCounter.png");
            $imageCounter++;
        }

        while (true) {
            $this->updatePlayerPosition($player, $grid, $size);
            if ($player->direction === Direction::Exit) {
                break;
            }

            if ($visualize) {
                $image = clone $sourceImage;
                $image->drawRectangle($player->x * $gridSize, $player->y * $gridSize, function (RectangleFactory $rectangle) use ($gridSize) {
                    $rectangle->size($gridSize, $gridSize);
                    $rectangle->background('red');
                });
                $image->save("/tmp/images/image$imageCounter.png");
                $imageCounter++;
            }

            $visited[$player->y][$player->x] = true;
        }

        foreach ($visited as $arr) {
            $answer += count($arr);
        }

        if ($visualize) {
            $image = $manager->animate(function ($animation) use ($imageCounter) {
                for ($i = 0; $i < $imageCounter; $i++) {
                    $animation->add("/tmp/images/image$i.png", .001);
                }
            })->setLoops(1);
            $image->save('/tmp/images/animated.gif');
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

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $player = new Player();
        $grid = [];
        $guaranteeVisit = [];

        $this->loadBoard($player, $grid, $input);
        $size = count($grid[0]);

        // Save starting location, we're going to brute force this thing
        $startX = $player->x;
        $startY = $player->y;

        // First solve on the default input so we can get a list of all visited locations
        // No need to place obstacles at every grid location, we only need to place them
        // on locations we were guaranteed to have visited.

        // This part takes <2ms
        $guaranteeVisit[$player->y][$player->x] = true;
        while (true) {
            $this->updatePlayerPosition($player, $grid, $size);
            $guaranteeVisit[$player->y][$player->x] = true;
            if ($player->direction === Direction::Exit) {
                break;
            }
        }

        // Loop through all guarantee visited cells, looking for a '.', and not the players current position
        foreach ($guaranteeVisit as $y => $cols) {
            foreach ($cols as $x => $true) {
                if ($grid[$y][$x] === '.' && ($y !== $startY || $x !== $startX)) {
                    // Reset player
                    $player->y = $startY;
                    $player->x = $startX;
                    $player->direction = Direction::North;
                    $visited = [];

                    // Place obstacle
                    $grid[$y][$x] = '#';

                    while (true) {
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
