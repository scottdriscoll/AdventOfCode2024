<?php

namespace App\Solutions\Day1;

use App\Solutions\SolutionInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-1-part-1')]
class Part1 implements SolutionInterface
{
    public function run(string $input): string
    {
        $firstArray = [];
        $secondArray = [];
        $answer = 0;

        foreach (explode("\n", $input) as $line) {
            sscanf($line, "%d   %d", $first, $second);
            $firstArray[] = $first;
            $secondArray[] = $second;
        }

        sort($firstArray);
        sort($secondArray);

        $total = count($firstArray);
        for ($i = 0; $i < $total; $i++) {
            $answer += abs($firstArray[$i] - $secondArray[$i]);
        }

        return (string) $answer;
    }
}
