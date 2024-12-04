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
        #[LiveProp] public string $output = '',
        #[LiveProp] public string $timing = '',
    ) {
    }

    #[LiveAction]
    public function run(#[LiveArg] int $part, SolutionRunner $runner): void
    {
        if (!empty($this->input)) {
            $model = $runner->run($this->day, $part, $this->input);
            $this->output = (string) $model->answer;
            $this->timing = $model->timing;
        } else {
            $this->output = '';
            $this->timing = '';
        }
    }
}
