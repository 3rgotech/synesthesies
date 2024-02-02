<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add(
            'texts.homepage_main_block',
            '<p>Nous menons une étude francophone sur la synesthésie et plus particulièrement sur le style cognitif des personnes synesthètes. Pour cela nous vous demandons de réaliser quelques tests mais également de répondre à un certain nombre de questions. Vous trouverez par la suite des précisons concernant le protocole de recherche et ce que votre participation implique.</p>'
        );
        $this->migrator->add(
            'texts.homepage_blocks',
            [
                [
                    'title' => 'Quel est l’objectif de l’étude ?',
                    'text' => '<p>La synesthésie est une manifestation subjective où la perception d’un élément (comme par exemple une lettre ou un son) entraine automatiquement une perception particulière (comme une couleur ou un gout). Il existe plusieurs formes de synesthésies et elle peut impliquer différentes les modalités sensorielles (vision, audition, odorat, toucher, goût). Plusieurs études rapportent un profil cognitif particulier chez les personnes synesthètes que ce soit concernant les capacités de représentation mentales ou bien encore la sensibilité sensorielle. L’objectif est d’étudier ce profil cognitif de façon un peu plus approfondie.</p>'
                ],
                [
                    'title' => 'Qu’est ce que cela implique ?',
                    'text' => '<p>Vous serez tout d’abord inviter à répondre à quelques questions sur vous et votre synesthésie. En fonction des synesthésies rapportées vous pourrez réaliser quelques tests pour tester votre synesthésie. Pour cette raison, il est recommandé d’utiliser un ordinateur et non pas une tablette ou un smartphone pour participer à ce protocole. Ensuite un certain nombre de questionnaires vous seront proposés. Vous pourrez accéder à toutes vos réponses.<br/>Si vous n’avez pas le temps de réaliser l’ensemble des questions, vous pouvez revenir à ce questionnaire pour le compléter plus tard.</p><h3>Vos droits à la confidentialité et au respect de la vie privée</h3><p>Votre participation à cette recherche est volontaire. Vous êtes donc libre de refuser de participer sans avoir à vous justifier. Si vous participez, vous pouvez décider à tout moment d’interrompre votre participation sans avoir à vous justifier et sans encourir aucune responsabilité ni aucun préjudice de ce fait.<br/><br/> La durée de conservation de vos données est de 10 ans après la publication des résultats de recherche. Au-delà de cette période, elles seront effacées.<br/><br/> Seuls le responsable scientifique et les chercheurs associés à ce projet auront accès à vos données. Les données recueillies seront traitées de façon conforme au Règlement général sur la protection des données (RGPD).<br/><br/> Cette étude a reçu l\'accord du Comité d\'Ethique de la Recherche de l\'Université de Toulouse.<br/><br/> Si vous estimez, après nous avoir contactés, que vos droits sur vos données ne sont pas respectés, vous pouvez adresser une réclamation (plainte) à la CNIL : <a href="https://www.cnil.fr/fr/webform/adresser-une-plainte">https://www.cnil.fr/fr/webform/adresser-une-plainte</a>.<br/><br/>Pour plus d\'informations, n\'hésitez pas à nous contacter :</p><ul><li>Lucie BOUVET (MCF, Laboratoire CERPPS, Université Toulouse 2 Jean Jaurès - <a href="mailto:lucie.bouvet@univ-tlse2.fr">lucie.bouvet@univ-tlse2.fr</a>), Responsable Scientifique du projet</li></ul>'
                ],
            ]
        );
        $this->migrator->add(
            'texts.consent_text',
            'En cliquant ici, vous indiquez que vous avez bien lu et compris les renseignements donnés et vous consentez à participer à cette recherche'
        );
    }
};
