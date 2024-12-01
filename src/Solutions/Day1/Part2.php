<?php

namespace App\Solutions\Day1;

use App\Solutions\SolutionInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-1-part-2')]
class Part2 implements SolutionInterface
{
    public function run(string $input): string
    {
        $firstArray = [];
        $secondArray = [];
        $answer = 0;

        foreach (explode("\n", $input) as $line) {
            sscanf($line, "%d   %d", $first, $second);
            $firstArray[] = $first;
            $secondArray[$second] = isset($secondArray[$second]) ? $secondArray[$second] + 1 : 1;
        }

        foreach ($firstArray as $val) {
            if (isset($secondArray[$val])) {
                $answer += $val * $secondArray[$val];
            }
        }

        return $answer;
    }
}
