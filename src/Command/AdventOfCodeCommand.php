<?php

namespace App\Command;

use App\Solutions\SolutionRunner;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'aoc',
    description: 'Runs Advent of Code 2024',
)]
class AdventOfCodeCommand extends Command
{
    public function __construct(
        private readonly SolutionRunner $runner,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('day', InputArgument::REQUIRED, 'Day to run')
            ->addArgument('part', InputArgument::REQUIRED, 'Part to run (1 or 2)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $day = (int) $input->getArgument('day');
        $part = (int) $input->getArgument('part');

        $io->info("Running $day $part...");

        $input = file_get_contents(__DIR__ . "/../Solutions/day$day.txt");

        $result = $this->runner->run($day, $part, $input);

        $io->success((string) $result);

        return Command::SUCCESS;
    }
}
