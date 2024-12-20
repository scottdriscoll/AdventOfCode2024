<?php

namespace App\Solutions;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('day-7', 44)]
class Day7 implements SolutionInterface
{
    public static function getDay(): int
    {
        return 7;
    }

    public function part1(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $dataArray = $this->parseInput($input);

        foreach ($dataArray as $data) {
            $check = $data['result'];
            $values = $data['values'];
            $first = array_shift($values);

            if ($this->resultMatches($check, $first, $values, ['*', '+'])) {
                $answer += $check;
            }
        }

        return $answer;
    }

    private function parseInput($input): array
    {
        $dataArray = [];

        foreach (explode("\n", $input) as $line) {
            $values = [];
            $arr = explode(':', $line);
            $result = (int) $arr[0];
            foreach (explode(' ', trim($arr[1])) as $value) {
                $values[] = (int) $value;
            }

            $dataArray[] = [
                'result' => $result,
                'values' => $values,
            ];
        }

        return $dataArray;
    }

    private function resultMatches(int $check, int $value, array $remaining, array $operators): bool
    {
        $num = array_shift($remaining);
        foreach ($operators as $operator) {
            $answer = 0;
            if ($operator === '||') {
                $answer = (int) "$value$num";
            } else {
                eval('$answer = (int)$value' . $operator . '$num;');
            }
            if ($answer === $check && empty($remaining)) {
                return true;
            }

            if (!empty($remaining)) {
                if ($this->resultMatches($check, $answer, $remaining, $operators)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function part2(string $input, bool $visualize = false): int
    {
        $answer = 0;
        $dataArray = $this->parseInput($input);

        foreach ($dataArray as $data) {
            $check = $data['result'];
            $values = $data['values'];
            $first = array_shift($values);

            if ($this->resultMatches($check, $first, $values, ['*', '+', '||'])) {
                $answer += $check;
            }
        }

        return $answer;
    }
}
