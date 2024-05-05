<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\Perception;
use App\Enum\Response;
use App\Models\Subject;
use App\Models\Test;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Administrateur Synesthésies',
            'email'             => 'admin@univ-tlse2.fr',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('password'),
        ]);
        if (App::isLocal()) {
            Subject::factory([
                'email'  => 'romain.goncalves@gmail.com',
                'synesthesies' => [
                    Perception::DIGIT->value        => [Response::COLOR->value],
                    Perception::LETTER->value       => [Response::COLOR->value],
                    Perception::FRENCH_WORD->value  => [Response::COLOR->value],
                    Perception::FOREIGN_WORD->value => [Response::COLOR->value],
                    Perception::DAY_OF_WEEK->value  => [Response::COLOR->value],
                    Perception::MUSIC->value        => [Response::COLOR->value],
                    Perception::HUMAN_VOICE->value  => [Response::COLOR->value],
                    Perception::SOUND->value        => [Response::COLOR->value],
                ]
            ])->create();
            Subject::factory()->count(10)->create();
        }
        $this->call([
            TestSeeder::class,
            LikertTestSeeder::class
        ]);
    }
}
