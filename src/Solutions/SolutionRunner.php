<?php

namespace App\Solutions;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Component\Stopwatch\Stopwatch;

readonly class SolutionRunner
{
    public function __construct(
        #[AutowireLocator(SolutionInterface::class)]
        private ContainerInterface $solutions,
    ) {
    }

    public function run(int $day, int $part, string $inputData): SolutionModel
    {
        /** @var SolutionInterface $solution */
        $solution = $this->solutions->get(sprintf('day-%s', $day));

        $stopwatch = new Stopwatch(true);
        $stopwatch->start('run');

        if ($part === 1) {
            $answer = $solution->part1($inputData);
        } else {
            $answer = $solution->part2($inputData);
        }

        return new SolutionModel(
            answer: $answer,
            timing: (string) ltrim($stopwatch->stop('run'), 'default/run: '),
        );
    }
}
