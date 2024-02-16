<?php

namespace Database\Factories;

use App\Enum\Disorder;
use App\Enum\Perception;
use App\Enum\Region;
use App\Enum\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $liveInFrance = fake()->boolean(80);
        $perceptions = Perception::cases();
        $responses = Response::cases();
        $synesthesies = collect($perceptions)
            ->random(fake()->numberBetween(1, count($perceptions)))
            ->mapWithKeys(fn (Perception $perception) => [
                $perception->value => fake()->randomElements($responses, allowDuplicates: false)
            ])
            ->all();
        $hasChanged = fake()->boolean();
        $problematic = fake()->boolean();

        return [
            'email'                => fake()->email(),
            'gender'               => fake()->randomElement(['m', 'f', 'o']),
            'birth_year'           => fake()->year(1900, 2000),
            'citizenship'          => $liveInFrance ? 'french' : 'other',
            'region'               => $liveInFrance ? fake()->randomElement(collect(Region::cases())->pluck('value')->toArray()) : null,
            'language'             => $liveInFrance ? 'french' : 'other',
            'keep_informed'        => fake()->boolean(),
            'disorders'            => fake()->randomElements(collect(Disorder::cases())->pluck('value')->toArray(), allowDuplicates: false),
            'other_disorders'      => fake()->boolean() ? fake()->sentences(3, true) : '',
            'diagnosis'            => fake()->randomElement(['doctor', 'self']),
            'synesthesies'         => $synesthesies,
            'spatial_synesthesies' => fake()->boolean() ? fake()->randomElements(['digit', 'month', 'year', 'other'], allowDuplicates: false) : [],
            'subtitles'            => fake()->boolean(),
            'always_existed'       => fake()->boolean(),
            'has_changed'          => $hasChanged,
            'has_changed_details'  => $hasChanged ? fake()->sentences(3, true) : '',
            'problematic'          => $problematic,
            'problematic_details'  => $problematic ? fake()->sentences(3, true) : '',
            'comments'             => fake()->sentences(3, true),
        ];
    }
}
