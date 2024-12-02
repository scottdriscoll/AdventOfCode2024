<?php

namespace App\Twig\Components;

use App\Solutions\SolutionRunner;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Solution
{
    use DefaultActionTrait;

    public function __construct(
        #[LiveProp] public int $day = 0,
        #[LiveProp(writable: true)] public string $input = '',
        #[LiveProp] public string $output = ''
    ) {
    }

    #[LiveAction]
    public function run(#[LiveArg] int $part, SolutionRunner $runner): void
    {
        if (empty($this->input)) {
            $this->output = "Enter your input first";

        } else {
            $this->output = $runner->run($this->day, $part, $this->input);
        }
    }
}
