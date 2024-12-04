<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\Stopwatch\StopwatchEvent;

#[Exclude]
readonly class SolutionModel
{
    public function __construct(
        public int $answer,
        public string $timing,
    ) {
    }
}
