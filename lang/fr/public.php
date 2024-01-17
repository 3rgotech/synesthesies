<?php

return [
    'home'       => 'Accueil',
    'login'      => 'Déjà venu ?',
    'legal'      => 'Mentions Légales',
    'privacy'    => 'Politique de Confidentialité',
    'start_test' => 'Commencer le test',

    'qualification' => [
        'steps' => [
            'information' => 'Informations',
            'medical'     => 'Historique médical',
        ],
        'fields' => [
            'gender'            => 'Genre',
            'birthYear'         => 'Année de Naissance',
            'citizenship'       => 'Nationalité',
            'liveInFrance'      => 'Habitez-vous en France ?',
            'region'            => 'Dans quelle région ?',
            'language'          => 'Langue Maternelle',
            'email'             => 'Email',
            'wantsToBeInformed' => 'Tenez-moi informé des résultats de cette recherche et des recherches futures sur cette thématique. (Fréquence estimée d\'un à deux e-mails par an)',
            'disorder'          => 'Avez-vous déjà eu un diagnostic de trouble neurodévelopppemental ?',
            'diagnosis'         => 'Est-ce que ce diagnostic a été'
        ],
        'values' => [
            'citizenship' => [
                'french' => 'Française',
                'other' => 'Autre',
            ],
            'language' => [
                'french' => 'Français',
                'other' => 'Autre',
            ],
            'diagnosis' => [
                'doctor' => 'Effectué par un professionnel (médecin, psychologue)',
                'self'   => 'C\'est un autodiagnostic qui n\'a pas été confirmé par un professionnel',
            ],
        ],
        'help' => [
            'email' => 'Vous permettra de retrouver vos réponses ainsi que les résultats à vos tests. (Ce mail sera uniquement utilisé dans le cadre de ce protocole de recherche)',
        ]
    ],
];
