<?php

return [
    'home'       => 'Accueil',
    'login'      => 'Déjà venu ?',
    'logout'     => 'Déconnexion',
    'legal'      => 'Mentions Légales',
    'privacy'    => 'Politique de Confidentialité',
    'start_test' => 'Commencer le test',
    'test_list'  => 'Liste des tests',

    'qualification' => [
        'steps'  => [
            'information'   => 'Informations&nbsp;(1)',
            'medical'       => 'Informations&nbsp;(2)',
            'synesthesies'  => 'Votre synesthésie&nbsp;(1)',
            'other-details' => 'Votre synesthésie&nbsp;(2)',
            'misc'          => 'Autres détails',
        ],
        'fields' => [
            'gender'                => 'Genre',
            'birthYear'             => 'Année de Naissance',
            'citizenship'           => 'Nationalité',
            'liveInFrance'          => 'Habitez-vous en France ?',
            'region'                => 'Dans quelle région ?',
            'language'              => 'Langue Maternelle',
            'email'                 => 'Email',
            'wantsToBeInformed'     => 'Tenez-moi informé des résultats de cette recherche et des recherches futures sur cette thématique. (Fréquence estimée d\'un à deux e-mails par an)',
            'disorder'              => 'Avez-vous déjà eu un diagnostic de trouble neurodévelopppemental ?',
            'diagnosis'             => 'Est-ce que ce diagnostic a été',
            'otherDisorders'        => 'Avez vous d\'autres troubles diagnostiqués ? (trouble anxieux, trouble dépressif, ...)',
            'synesthesies_question' => 'Lorsque vous percevez les éléments suivants, avez-vous une expérience synesthétique ?',
            'synesthesies_nothing'  => 'Pas d\'expérience synesthétique avec cette perception',
            'spatialSynesthesies'   => 'Certaines personnes font l\'expérience pour des séquences particulières (chiffres, mois, années, ...) d\'un arrangement spatial spécifique comme ceci',
            'subtitles'             => 'Certaines personnes, lorsqu\'elles entendent de la parole, voient les mots écrits devant elles (comme des sous-titres). Parfois ces mots peuvent être colorés ou pas.',
            'alwaysExisted'         => 'Est-ce que vous avez votre synesthésie depuis aussi longtemps que vous vous en souvenez ?',
            'hasChanged'            => 'Est-ce que vos associations synesthétiques changent parfois ?',
            'problematic'           => 'Est-ce que votre synesthésie vous gêne parfois ?',
            'comments'              => 'Est-ce que y aurait d\'autres choses dont vous souhaiteriez nous faire part en lien avec votre synesthésie ?',

            'isItTheCase'  => 'Est-ce que c\'est le cas pour vous ?',
            'ifYesExplain' => 'Si oui, expliquez',
        ],
        'values' => [
            'citizenship' => [
                'french' => 'Française',
                'other'  => 'Autre',
            ],
            'language'    => [
                'french' => 'Français',
                'other'  => 'Autre',
            ],
            'diagnosis'   => [
                'doctor' => 'Effectué par un professionnel (médecin, psychologue)',
                'self'   => 'C\'est un autodiagnostic qui n\'a pas été confirmé par un professionnel',
            ],
            'perception'  => [
                'letter'       => 'Lettres de l\'alphabet',
                'french_word'  => 'Mot écrit en français',
                'foreign_word' => 'Mot écrit en langue étrangère',
                'digit'        => 'Chiffres',
                'day_of_week'  => 'Jours de la semaine',
                'music'        => 'Musique',
                'human_voice'  => 'Voix humaines',
                'sound'        => 'Bruits',
            ],
            'spatial'     => [
                'digit' => 'Chiffre',
                'month' => 'Mois',
                'year'  => 'Année',
                'other' => 'Autre(s)',
            ],
            'boolean'     => [
                'yes'     => 'Oui',
                'no'      => 'Non',
                'unknown' => 'Ne sait pas',
            ]
        ],
        'help'   => [
            'email' => 'Vous permettra de retrouver vos réponses ainsi que les résultats à vos tests. (Ce mail sera uniquement utilisé dans le cadre de ce protocole de recherche)',
        ]
    ],

    'list' => [
        'synesthesies'             => 'Synesthésies',
        'synesthesies_description' => 'Ces tests nous permettent d’évaluer de façon objective certaines formes de synesthésie. Un des critères utilisés est la consistance des associations dans le temps. Après chaque test, vous verrez votre taux de consistance pour chaque type d’association. Les personnes synesthètes obtiennent un score plus faible, soit un taux élevé de consistance. Attention il n’est pas possible de refaire un test.',
        'likert'                   => 'Personnalité',
        'likert_description'       => 'Ces tests sont destinés à évaluer votre personnalité afin de nous fournir le contexte nécessaire lors de l\'analyse de vos résultats.',
        'empty'                    => 'Aucun test disponible pour le moment.',
    ],

    'test' => [
        'duration'                   => 'Durée estimée :',
        'check_result'               => 'Consulter mon résultat',
        'perform_test'               => 'Faire le test',
        'unsupported'                => 'Ce type de test n\'est pas supporté pour le moment. Veuillez nous contacter pour plus d\'informations.',
        'distinct_colors'            => 'Couleurs distinctes',
        'no_color'                   => 'Aucune couleur',
        'next'                       => 'Suivant',
        'final_score'                => 'Score final :',
        'final_score_explanation'    => 'Ce score est calculé en fonction de vos sélections. Plus il est faible, plus il indique la présence de synesthésies.',
        'back_to_list'               => 'Retour à la liste des tests',
        'save'                       => 'Enregistrer mes réponses',
        'evolutive_perception_audio' => 'Est-ce que votre perception évolue en fonction du son (dynamique), ou bien est-elle fixe (statique) ?',
        'shape_perception_audio'     => 'Percevez-vous également une forme lorsque vous entendez ce son ?',
        'evolutive_dynamic'          => 'Perception Dynamique',
        'evolutive_static'           => 'Perception Statique',
        'shape' => [
            'none'     => 'Pas de forme',
            'circle'   => 'Rond',
            'triangle' => 'Triangle',
            'square'   => 'Carré',
            'sinus'    => 'Sinusoïde',
            'line'     => 'Trait',
            'other'    => 'Autre forme',
        ],
        'score_criteria'             => [
            'object'  => 'Objet',
            'spatial' => 'Spatial',
            'verbal'  => 'Verbal',
        ]
    ]
];
