<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TextContentSettings extends Settings
{
    public string $homepage_main_block;
    public array $homepage_blocks;
    public string $consent_text;

    public static function group(): string
    {
        return 'texts';
    }
}
