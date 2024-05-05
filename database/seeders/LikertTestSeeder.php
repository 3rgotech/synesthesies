<?php

namespace Database\Seeders;

use App\Models\LikertTest;
use Illuminate\Database\Seeder;

class LikertTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->osivq();
        $this->wbsi();
        $this->fits();
        $this->gad7();
    }

    public function osivq(): void
    {
        $osivq = LikertTest::create([
            'title'        => "Questionnaire d'Imagerie Spatiale-Objet et Verbal",
            'description'  => null,
            'duration'     => '20 minutes',
            'icon'         => 'fas-cube',
            'introduction' => "<p>Ceci est un questionnaire sur votre façon de penser. Merci de lire attentivement les affirmations suivantes et d'évaluer chacune d'elles sur une échelle de 5 points. <br>Cliquez sur \"5\" si vous êtes absolument d'accord avec l'énoncé. <br>Cliquez \"1\" pour indiquer que vous êtes totalement en désaccord avec cet énoncé. <br>Cliquez \"3\" si vous n'êtes pas sûr, mais essayez de faire un choix. <br>Il est très important que vous répondiez à toutes les affirmations du questionnaire.</p>",
            'scale'        => [
                '1' => '1 - Totalement en désaccord',
                '2' => '2 - Plutôt en désaccord',
                '3' => '3 - Ne sais pas',
                '4' => '4 - Plutôt en accord',
                '5' => '5 - Totalement en accord',
            ],
            'fixed_order'              => true,
            'score_computation_method' => 'osivq',
            'score_explanation' => 'Ce score permet d\'identifier les types d\'imagerie mentale les plus développés. Chaque critère est évalué sur une échelle de 15 à 75 points.'
        ]);
        $osivq->questions()->createMany([
            ["order" => 1, "question" => "Quand j'étais étudiant(e), j'étais très bon(ne) en géométrie 3D"],
            ["order" => 2, "question" => "Il est difficile pour moi de m'exprimer par écrit"],
            ["order" => 3, "question" => "Mes compétences verbales rendraient une carrière dans les langues relativement facile pour moi"],
            ["order" => 4, "question" => "L'architecture m'intéresse plus que la peinture"],
            ["order" => 5, "question" => "Mes images mentales sont très colorées et claires"],
            ["order" => 6, "question" => "Je préfère les diagrammes schématiques et les croquis quand je lis un manuel plutôt que des illustrations imagées"],
            ["order" => 7, "question" => "J'ai plus de facilité à raconter des blagues et des histoires que la plupart des gens"],
            ["order" => 8, "question" => "Il est difficile pour moi de rédiger des dissertations et je n'aime pas du tout faire ça"],
            ["order" => 9, "question" => "Quand je lis de la fiction, je me forme habituellement une image mentale claire et détaillée d'une scène ou d'une pièce qui a été décrite"],
            ["order" => 10, "question" => "Si on me demandait de choisir entre un métier d'ingénieur et un métier dans les arts visuels, je choisirais les arts visuels"],
            ["order" => 11, "question" => "J'ai une mémoire photographique"],
            ["order" => 12, "question" => "Je peux facilement imaginer et faire pivoter mentalement des figures géométriques tridimensionnelles"],
            ["order" => 13, "question" => "Mes compétences verbales sont excellentes"],
            ["order" => 14, "question" => "Lorsque je pense à un concept abstrait (ou à une construction), j'imagine mentalement une construction abstraite schématique ou son plan plutôt qu'une construction spécifique concrète"],
            ["order" => 15, "question" => "Lorsque j'entre dans un magasin familier pour obtenir un article spécifique, je peux facilement visualiser la localisation exacte de cet article, l'étagère sur laquelle il se trouve, comment il est arrangé et les articles environnants"],
            ["order" => 16, "question" => "Mes images mentales sont très vives et photographiques"],
            ["order" => 17, "question" => "Mes images mentales de différents objets ressemblent beaucoup, en termes de taille, de forme et de couleur, aux vrais objets que j'ai vus"],
            ["order" => 18, "question" => "Quand j'imagine le visage d'un ami, j'ai une image parfaitement claire et précise"],
            ["order" => 19, "question" => "J'ai d'excellentes capacités en graphisme technique"],
            ["order" => 20, "question" => "Je peux facilement me rappeler d'un très grand nombre de détails visuels que quelqu'un d'autre pourrait ne jamais remarquer. Par exemple, j'enregistre automatiquement certaines choses comme de quelle couleur est la chemise que quelqu'un porte ou de quelle couleur sont ses chaussures"],
            ["order" => 21, "question" => "Je peux facilement dessiner un plan d'un bâtiment que je connais bien"],
            ["order" => 22, "question" => "A l'école, je n'avais pas de problèmes avec la géométrie"],
            ["order" => 23, "question" => "Je suis bon(ne) pour jouer à des jeux spatiaux impliquant la construction à partir de blocs et de papier (par exemple : Lego, Tetris, Origami)"],
            ["order" => 24, "question" => "Parfois, mes images mentales sont tellement vives et persistantes qu'il est difficile de les ignorer"],
            ["order" => 25, "question" => "Je peux fermer les yeux et facilement percevoir une image d'une scène que j'ai vécue"],
            ["order" => 26, "question" => "Les mots me viennent plus facilement que la moyenne"],
            ["order" => 27, "question" => "Je suis toujours conscient(e) de la structure des phrases"],
            ["order" => 28, "question" => "J'apprécie d'être capable de reformuler mes pensées de nombreuses façons, par souci de variation, à la fois à l'écrit et à l'oral"],
            ["order" => 29, "question" => "Je me rappelle de tout visuellement. Je peux décrire ce que les gens portaient au diner et je peux parler de comment ils étaient assis et de quoi ils avaient l'air, et ce, avec probablement plus de détails que je ne pourrais discuter de ce qu'ils ont dit"],
            ["order" => 30, "question" => "J'ai parfois un problème pour exprimer exactement ce que je veux dire"],
            ["order" => 31, "question" => "Je trouve cela difficile d'imaginer à quoi ressemblerait exactement une figure géométrique tridimensionnelle lors d'une rotation"],
            ["order" => 32, "question" => "Mes images visuelles sont dans ma tête tout le temps. Elles sont justes là"],
            ["order" => 33, "question" => "Mes capacités graphiques rendraient une carrière dans l'architecture relativement facile pour moi"],
            ["order" => 34, "question" => "Quand j'entends un animateur radio ou un DJ que je n'ai jamais réellement vu, je me retrouve généralement à imaginer à quoi il pourrait ressembler"],
        ]);
    }

    public function wbsi(): void
    {
        $wbsi = LikertTest::create([
            'title'        => 'Inventaire des Tendances à la Suppression (WBSI)',
            'description'  => null,
            'duration'     => '10 minutes',
            'icon'         => 'fas-head-side-virus',
            'introduction' => "<p>Ce questionnaire porte sur les pensées. Il n'y a pas de bonnes ou mauvaises réponses, alors veuillez répondre honnêtement à chaque item ci-dessous. Assurez-vous de bien donner une réponse à chaque item en encerclant la lettre appropriée.</p>",
            'scale'        => [
                '1' => "1 - Pas du tout d'accord",
                '2' => "2 - Pas d'accord",
                '3' => "3 - Neutre ou je ne sais pas",
                '4' => "4 - D'accord",
                '5' => "5 - Tout à fait d'accord",
            ],
            'fixed_order'              => false,
            'score_computation_method' => null,
        ]);
        $wbsi->questions()->createMany([
            ['order' => 1,  'question' => "Il y a des choses auxquelles je préfère ne pas penser."],
            ['order' => 2,  'question' => "Quelquefois je me demande pourquoi j'ai les pensées que j'ai."],
            ['order' => 3,  'question' => "J'ai des pensées que je ne peux pas arrêter."],
            ['order' => 4,  'question' => "Il y a des images qui me viennent à l'esprit que je ne peux pas effacer."],
            ['order' => 5,  'question' => "Mes pensées reviennent fréquemment à une même idée."],
            ['order' => 6,  'question' => "Je souhaiterais pouvoir arrêter de penser à certaines choses."],
            ['order' => 7,  'question' => "Quelquefois mon esprit s'emballe si vite que je souhaiterais pouvoir l'arrêter."],
            ['order' => 8,  'question' => "J'essaie toujours d'écarter les problèmes hors de mon esprit."],
            ['order' => 9,  'question' => "Il y a des pensées qui n'arrêtent pas de surgir dans ma tête."],
            ['order' => 10, 'question' => "Quelquefois je reste occupé(e) seulement pour empêcher que des pensées fassent intrusion dans mon esprit."],
            ['order' => 11, 'question' => "Il y a des choses auxquelles j'essaie de ne pas penser."],
            ['order' => 12, 'question' => "Quelquefois je souhaiterais vraiment pouvoir arrêter de penser."],
            ['order' => 13, 'question' => "Je fais souvent des choses pour me distraire de mes pensées."],
            ['order' => 14, 'question' => "J'ai des pensées que j'essaie d'éviter."],
            ['order' => 15, 'question' => "Il y a beaucoup de pensées que j'ai dont je ne parle à personne."],
        ]);
    }

    public function fits(): void
    {
        $fits = LikertTest::create([
            'title'        => 'Fréquence des Pensées Involontaires (FITS)',
            'description'  => null,
            'duration'     => '5 minutes',
            'icon'         => 'fas-brain',
            'introduction' => "<p>De nombreuses personnes ont des <strong>pensées involontaires</strong>. Les pensées involontaires viennent
            à l'esprit sans effort et sans contrôle conscient. Elles peuvent être agréables ou désagréables.<br>Ici, nous nous intéressons à <strong>la fréquence</strong> à laquelle vous éprouvez différents types de pensées involontaires au quotidien.<br>À quelle fréquence les types de pensées involontaires suivants vous arrivent-ils ?</p>",
            'scale' => [
                '1' => 'Jamais',
                '2' => 'Presque jamais',
                '3' => 'Plusieurs fois par mois',
                '4' => 'Plusieurs fois par semaine',
                '5' => 'Plusieurs fois par jour',
                '6' => 'Constamment',
            ],
            'fixed_order'              => true,
            'score_computation_method' => null,
        ]);
        $fits->questions()->createMany([
            ['order' => 1, 'question' => "Des chansons / musiques"],
            ['order' => 2, 'question' => "Des images visuelles"],
            ['order' => 3, 'question' => "Des souvenirs"],
            ['order' => 4, 'question' => "Des pensées concernant le futur"],
            ['order' => 5, 'question' => "Des pensées sur les relations amoureuses"],
            ['order' => 6, 'question' => "Des pensées à propos d'autres formes de relations interpersonnelles (amitié, famille,...)"],
            ['order' => 7, 'question' => "Des pensées à propos du travail"],
            ['order' => 8, 'question' => "Des pensées en rapport avec l'argent"],
        ]);
    }

    public function gad7(): void
    {
        $fits = LikertTest::create([
            'title'        => 'Dépistage du Trouble Anxieux Généralisé (GAD-7)',
            'description'  => null,
            'duration'     => '5 minutes',
            'icon'         => 'fas-cloud-bolt',
            'introduction' => '<p>Au cours des 14 derniers jours, à quelle fréquence avez-vous été dérangé(e) par les problèmes suivants ?</p>',
            'scale'        => [
                '1' => 'Jamais',
                '2' => 'Plusieurs jours',
                '3' => 'Plus de la moitié des jours',
                '4' => 'Presque tous les jours',
            ],
            'fixed_order'              => false,
            'score_computation_method' => null,
        ]);
        $fits->questions()->createMany([
            ['order' => 1, 'question' => "Sentiment de nervosité, d'anxiété ou de tension"],
            ['order' => 2, 'question' => "Incapable d'arrêter de vous inquiéter ou de contrôler vos inquiétudes"],
            ['order' => 3, 'question' => "Inquiétudes excessives à propos de tout et de rien"],
            ['order' => 4, 'question' => "Difficulté à se détendre"],
            ['order' => 5, 'question' => "Agitation telle qu'il est difficile de rester tranquille"],
            ['order' => 6, 'question' => "Devenir facilement contrarié(e) ou irritable"],
            ['order' => 7, 'question' => "Avoir peur que quelque chose d'épouvantable puisse arriver"],
        ]);
    }
}
