<?php

namespace App\Utils;

class LikertTestScore
{
    public static function osivq(array $data): array
    {
        $categories = [
            'object'  => [5, 9, 10, 11, 15, 16, 17, 18, 20, 24, 25, 29, 32, 34],
            'spatial' => [1, 4, 6, 12, 14, 19, 21, 22, 23, 31, 33],
            'verbal'  => [2, 3, 7, 8, 13, 26, 27, 28, 30],
        ];
        $inverted = [2, 8, 30, 31];
        $results = [
            'object'  => 0,
            'spatial' => 0,
            'verbal'  => 0,
        ];

        foreach ($categories as $category => $questions) {
            foreach ($questions as $q) {
                // If $question index is inverted, invert the score (5 becomes 1 ; 4 becomes 2 ; 3 stays 3 ; 2 becomes 4 ; 1 becomes 5)
                $score = $data[$q];
                if (in_array($q, $inverted)) {
                    $score = 6 - $score;
                }
                $results[$category] += $score;
            }
            // Constrain category score between 15 and 75
            $results[$category] = min(75, max(15, $results[$category]));
        }

        return $results;
    }
}
