<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface SolutionInterface
{
    public static function getDay(): int;
    public function part1(string $input, bool $visualize = false): int;
    public function part2(string $input, bool $visualize = false): int;
}
