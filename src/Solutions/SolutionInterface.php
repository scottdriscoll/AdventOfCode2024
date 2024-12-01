<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface SolutionInterface
{
    public function run(string $input): string;
}
