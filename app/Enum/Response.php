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
    case SPACE = 'space';

    public function getLabel(): string
    {
        return __('enums.response.' . $this->value);
    }

    public function userSelectable(): bool
    {
        if ($this === self::SPACE) {
            return false;
        }
        return true;
    }

    public static function values(): array
    {
        return collect(self::cases())->map(fn (self $item) => $item->value)->all();
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::COLOR => 'fas-palette',
            self::TASTE => 'fas-lemon',
            self::MUSIC => 'fas-music',
            self::SHAPE => 'fas-shapes',
            self::SCENT => 'fas-spray-can-sparkles',
            self::PAIN  => 'fas-kit-medical',
            self::TOUCH => 'fas-fingerprint',
            default     => null
        };
    }
}
