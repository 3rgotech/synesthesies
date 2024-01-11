<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum Region: string implements HasLabel
{
    case AUVERGNE_RHONE_ALPES        = 'auvergne-rhone-alpes';
    case BOURGOGNE_FRANCHE_COMTE     = 'bourgogne-franche-comte';
    case BRETAGNE                    = 'bretagne';
    case CENTRE_VAL_DE_LOIRE         = 'centre-val-de-loire';
    case CORSE                       = 'corse';
    case GRAND_EST                   = 'grand-est';
    case HAUTS_DE_FRANCE             = 'hauts-de-france';
    case ILE_DE_FRANCE               = 'ile-de-france';
    case NORMANDIE                   = 'normandie';
    case NOUVELLE_AQUITAINE          = 'nouvelle-aquitaine';
    case OCCITANIE                   = 'occitanie';
    case PAYS_DE_LA_LOIRE            = 'pays-de-la-loire';
    case PROVENCE_ALPES_COTE_D_AZURE = 'provence-alpes-cote-d-azur';

    public function getLabel(): string
    {
        return __('enums.region.' . $this->value);
    }
}
