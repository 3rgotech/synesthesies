<?php

namespace App\Filament\Pages;

use App\Settings\TextContentSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class ManageTextContent extends SettingsPage
{
    protected static ?string $navigationIcon = 'fas-file-lines';

    protected static string $settings         = TextContentSettings::class;
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?int $navigationSort     = 2;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('homepage_main_block')
                    ->label(__('filament.manage_text_content.homepage_main_block'))
                    ->columnSpanFull(),
                Repeater::make('homepage_blocks')
                    ->label(__('filament.manage_text_content.homepage_blocks'))
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->label(__('filament.title')),
                        RichEditor::make('text')
                            ->label(__('filament.text'))
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->addActionLabel('+')
                    ->collapsible(),
                RichEditor::make('consent_text')
                    ->label(__('filament.manage_text_content.consent_text'))
                    ->columnSpanFull(),
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.manage_text_content.title');
    }

    public function getTitle(): string | Htmlable
    {
        return __('filament.manage_text_content.title');
    }
}
