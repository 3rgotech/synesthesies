<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel
{
    case FEMALE = 'f';
    case MALE   = 'm';
    case OTHER  = 'o';

    public function getLabel(): string
    {
        return __('enums.gender.' . $this->value);
    }
}
