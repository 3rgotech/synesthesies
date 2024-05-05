<?php

namespace Database\Seeders;

use App\Enum\Perception;
use App\Enum\Response;
use App\Models\Test;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Test::upsert(
            [
                [
                    'title'        => 'Coloration des Lettres',
                    'description'  => 'Test de coloration des lettres',
                    'introduction' => '<p>Dans ce test, vous devrez choisir la couleur que vous percevez pour certaines lettres de
                    l’alphabet. Ces lettres vous seront présentées plusieurs fois.</p>',
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
                    'title'        => 'Coloration des Nombres',
                    'description'  => 'Test de coloration des Nombres',
                    'introduction' => '<p>Dans ce test, vous devrez choisir la couleur ou les couleurs que vous percevez pour différents chiffres. Ces chiffres vous seront présentés plusieurs fois.</p>',
                    'duration'     => '10 minutes',
                    'icon'         => 'fas-3',
                    'perception'   => Perception::DIGIT,
                    'response'     => Response::COLOR,
                    'stimuli'      => json_encode(
                        App::isLocal()
                            ? [3, 16]
                            : [...range(0, 10), 16, 23, 58, 74, 90]
                    ),
                ],
                [
                    'title'        => 'Coloration des Jours',
                    'description'  => 'Test de coloration des Jours de la Semaine',
                    'introduction' => '<p>Dans ce test, vous devrez choisir la couleur que vous percevez pour certains jours de la semaine. Ces jours vous seront présentés plusieurs fois.</p>',
                    'duration'     => '5 minutes',
                    'icon'         => 'fas-calendar-days',
                    'perception'   => Perception::DAY_OF_WEEK,
                    'response'     => Response::COLOR,
                    'stimuli'      => json_encode(
                        App::isLocal()
                            ? ['Lundi', 'Mardi']
                            : ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']
                    ),
                ],
                [
                    'title'        => 'Coloration des Voix',
                    'description'  => 'Test de coloration des Voix Humaines',
                    'introduction' => '<p>Dans ce test, vous devrez choisi la couleur ou les couleurs que vous percevez pour différents sons du langage. Vous pourrez écouter ces sons autant de fois que vous le souhaitez. Vous pourrez également indiquer si vous voyez une forme particulière à l’écoute de ce son. Ces sons vous seront présentés plusieurs fois.</p>',
                    'duration'     => '5 minutes',
                    'icon'         => 'fas-ear-listen',
                    'perception'   => Perception::HUMAN_VOICE,
                    'response'     => Response::COLOR,
                    'stimuli'      => json_encode(
                        App::isLocal()
                            ? ['A Pascal', 'OU Cynthia']
                            : ['A Cynthia', 'A Pascal', 'I Cynthia', 'I Julien', 'OU Cynthia', 'OU Julien']
                    ),
                ],
                [
                    'title'        => 'Positionnement spatial des mois',
                    'description'  => 'Test de positionnement spatial des mois',
                    'introduction' => '<p>Dans ce test, vous devrez choisir la localisation spatiale de différents mois de l’année. Projetez votre représentation dans l’espace de votre écran. Vous devrez tout d’abord positionnez ces mois tous ensemble puis ensuite la position de chaque mois vous sera demandé plusieurs fois.</p>',
                    'duration'     => '15 minutes',
                    'icon'         => 'far-calendar-alt',
                    'perception'   => Perception::MONTH,
                    'response'     => Response::SPACE,
                    'stimuli'      => json_encode(
                        App::isLocal()
                            ? ['Janvier', 'Février']
                            : ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']
                    ),
                ]
            ],
            ['perception', 'response'],
            ['title', 'description', 'duration', 'stimuli']
        );

        /** @var Test $voiceColor */
        $voiceColor = Test::where('perception', Perception::HUMAN_VOICE)
            ->where('response', Response::COLOR)
            ->first();
        $voiceColor->clearMediaCollection('audio_files');
        if (App::isLocal()) {
            $files = ['a_pascal.wav', 'ou_cynthia.wav'];
        } else {
            $files = ['a_cynthia.wav', 'a_pascal.wav', 'i_cynthia.wav', 'i_julien.wav', 'ou_cynthia.wav', 'ou_julien.wav'];
        }
        foreach ($files as $file) {
            $voiceColor->addMedia(Storage::disk('local')->path('voices/' . $file))
                ->preservingOriginal()
                ->toMediaCollection('audio_files');
        }
    }
}
