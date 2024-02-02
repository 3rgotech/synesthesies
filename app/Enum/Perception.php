<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum Perception: string implements HasLabel
{
    case LETTER = 'letter';
    case FRENCH_WORD = 'french_word';
    case FOREIGN_WORD = 'foreign_word';
    case DIGIT = 'digit';
    case DAY_OF_WEEK = 'day_of_week';
    case MUSIC = 'music';
    case HUMAN_VOICE = 'human_voice';
    case SOUND = 'sound';

    public function getLabel(): string
    {
        return __('enums.perception.' . $this->value);
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LETTER => 'fas-font',
            self::FRENCH_WORD => 'fas-signature',
            self::FOREIGN_WORD => 'fas-signature',
            self::DIGIT => 'fas-3',
            self::DAY_OF_WEEK => 'fas-calendar-day',
            self::MUSIC => 'fas-music',
            self::HUMAN_VOICE => 'fas-ear-listen',
            self::SOUND => 'fas-volume-high',
        };
    }
}
