<?php

namespace App\Utils;

class Math
{
    public static function combinations(array $items, int $length): array
    {
        $combinations = [[]];

        foreach ($items as $item) {
            $currentCombinations = $combinations;

            foreach ($currentCombinations as $combination) {
                if (count($combination) < $length) {
                    $combinations[] = array_merge($combination, [$item]);
                }
            }
        }

        // Filter out combinations with the wrong length
        $combinations = array_filter($combinations, function ($combination) use ($length) {
            return count($combination) === $length;
        });

        return $combinations;
    }

    public static function distance(?array $a, ?array $b): float
    {
        // If both $a and $b are null, return 0
        if (is_null($a) && is_null($b)) {
            return 0;
        }

        // If either $a or $b is null, replace it with an array of zeroes of the same size
        if (is_null($a)) {
            $a = array_fill(0, count($b), 0);
        }
        if (is_null($b)) {
            $b = array_fill(0, count($a), 0);
        }

        // Compute the euclidian distance between $a and $b (either 2 or 3 dimensions points)
        $sum = 0;
        if (array_is_list($a)) {
            for ($i = 0; $i < count($a); $i++) {
                $sum += pow(($a[$i] - $b[$i]), 2);
            }
        } else {
            foreach (array_keys($a) as $key) {
                $sum += pow(($a[$key] - $b[$key]), 2);
            }
        }
        return sqrt($sum);
    }
}
