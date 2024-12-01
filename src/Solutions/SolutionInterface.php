<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface SolutionInterface
{
    public function part1(string $input): int;
    public function part2(string $input): int;
}
