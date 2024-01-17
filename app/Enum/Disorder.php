<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum Disorder: string implements HasLabel
{
    case AUTISM       = 'autism';
    case ATTENTION    = 'attention';
    case DYSLEXIA     = 'dyslexia';
    case DYSCALCULIA  = 'dyscalculia';
    case MOTOR        = 'motor';
    case LANGUAGE     = 'language';
    case INTELLECTUAL = 'intellectual';
    case GIFTED       = 'gifted';

    public function getLabel(): string
    {
        return __('enums.disorder.' . $this->value);
    }
}
