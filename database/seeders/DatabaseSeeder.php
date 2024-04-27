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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->write(
            Task::class,
            'Creating admin user',
            function () {
                User::create([
                    'name'              => 'Administrateur Synesthésies',
                    'email'             => 'admin@univ-tlse2.fr',
                    'email_verified_at' => Carbon::now(),
                    'password'          => Hash::make('password'),
                ]);
            }
        );
        $this->write(
            Task::class,
            'Creating test data',
            function () {
                Test::upsert(
                    [
                        [
                            'title'       => 'Coloration des Lettres',
                            'description' => 'Test de coloration des lettres',
                            'duration'    => '15 minutes',
                            'icon'        => 'fas-font',
                            'perception'  => Perception::LETTER,
                            'response'    => Response::COLOR,
                            'stimuli'     => json_encode(
                                App::isLocal()
                                    ? ['A', 'B']
                                    : range('A', 'Z')
                            ),
                        ],
                        [
                            'title'       => 'Coloration des Nombres',
                            'description' => 'Test de coloration des Nombres',
                            'duration'    => '10 minutes',
                            'icon'        => 'fas-3',
                            'perception'  => Perception::DIGIT,
                            'response'    => Response::COLOR,
                            'stimuli'     => json_encode(
                                App::isLocal()
                                    ? [3, 16]
                                    : [...range(0, 10), 16, 23, 58, 74, 90]
                            ),
                        ],
                        [
                            'title'       => 'Coloration des Jours',
                            'description' => 'Test de coloration des Jours de la Semaine',
                            'duration'    => '5 minutes',
                            'icon'        => 'fas-calendar-days',
                            'perception'  => Perception::DAY_OF_WEEK,
                            'response'    => Response::COLOR,
                            'stimuli'     => json_encode(
                                App::isLocal()
                                    ? ['Lundi', 'Mardi']
                                    : ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']
                            ),
                        ]
                    ],
                    ['perception', 'response'],
                    ['title', 'description', 'duration', 'stimuli']
                );
            }
        );
        if (App::isLocal()) {
            $this->write(
                Task::class,
                'Creating subjects',
                function () {
                    Subject::factory()->count(10)->create();
                }
            );
        }
    }

    /**
     * Write to the console's output.
     *
     * @param  string  $component
     * @param  array<int, string>|string  $arguments
     * @return void
     */
    protected function write($component, ...$arguments)
    {
        if ($this->command->getOutput() && class_exists($component)) {
            (new $component($this->command->getOutput()))->render(...$arguments);
        } else {
            foreach ($arguments as $argument) {
                if (is_callable($argument)) {
                    $argument();
                }
            }
        }
    }
}
