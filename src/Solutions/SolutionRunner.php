<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Contracts\Service\ServiceCollectionInterface;

readonly class SolutionRunner
{
    public function __construct(
        #[AutowireLocator(SolutionInterface::class)]
        private iterable $solutions,
    ) {
    }

    public function run(int $day, int $part, string $inputData): int
    {
        /** @var SolutionInterface $solution */
        $solution = $this->solutions->get(sprintf('day-%s', $day));

        if ($part === 1) {
            return $solution->part1($inputData);
        }

        return $solution->part2($inputData);
    }
}
