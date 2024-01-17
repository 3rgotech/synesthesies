<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum Response: string implements HasLabel
{
    case COLOR = 'color';
    case TASTE = 'taste';
    case MUSIC = 'music';
    case SHAPE = 'shape';
    case SCENT = 'scent';
    case PAIN  = 'pain';
    case TOUCH = 'touch';

    public function getLabel(): string
    {
        return __('enums.response.' . $this->value);
    }

    public static function values(): array
    {
        return collect(self::cases())->map(fn (self $item) => $item->value)->all();
    }
}
