<?php

namespace App\Solutions;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;

class SolutionRunner
{
    public function __construct(
        #[AutowireLocator(SolutionInterface::class)]
        private ContainerInterface $solutions,
    ) {
    }

    public function run(int $day, int $part, string $inputData, SymfonyStyle $io): void
    {
        $tag = sprintf('day-%s-part-%s', $day, $part);

        if (!$this->solutions->has($tag)) {
            $io->error("Solution with tag $tag does not exist");

            return;
        }

        $io->info("Running Day $day Part $part.");

        $output = $this->solutions->get($tag)->run($inputData);

        $io->writeln($output);
    }
}
