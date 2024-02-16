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

    public static function distance(array $a, array $b): float
    {
        // Compute the euclidian distance between $a and $b (either 2 or 3 dimensions points)
        $sum = 0;
        for ($i = 0; $i < count($a); $i++) {
            $sum += pow(($a[$i] - $b[$i]), 2);
        }
        return sqrt($sum);
    }
}
