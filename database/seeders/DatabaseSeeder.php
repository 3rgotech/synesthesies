<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
