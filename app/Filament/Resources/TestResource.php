<?php

namespace App\Filament\Resources;

use App\Enum\Perception;
use App\Enum\Response;
use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn\IconColumnSize;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon   = 'fas-clipboard-question';
    protected static ?string $navigationGroup  = 'Paramètres';
    protected static ?int $navigationSort      = 10;
    protected static ?string $navigationLabel  = 'Tests Synesthétiques';
    protected static ?string $modelLabel       = 'Test Synesthétiques';
    protected static ?string $pluralModelLabel = 'Tests Synesthétiques';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                IconPicker::make('icon')
                    ->label('Icône')
                    ->columns([
                        'default' => 1,
                        'lg'      => 3,
                        '2xl'     => 5,
                    ])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('perception')
                    ->label('Perception')
                    ->options(Perception::class)
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('response')
                    ->label('Réponse')
                    ->options(Response::class)
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->label('Durée estimée')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('repetitions')
                    ->label('Nombre de répétitions des stimuli')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Forms\Components\Repeater::make('stimuli')
                    ->label('Stimuli')
                    ->simple(
                        Forms\Components\TextInput::make('stimuli')
                            ->required()
                            ->columnSpanFull()
                    )
                    // ->afterStateHydrated(function ($component, $state) {
                    //     $component->state(implode(', ', $state ?? []));
                    // })
                    // ->dehydrateStateUsing(fn (string $state) => array_filter(array_map('trim', explode(',', $state))))
                    ->helperText(function (Get $get) {
                        $perception = Perception::tryFrom($get('perception'));
                        if ($perception?->isVisual()) {
                            return "Séparer les stimuli par des virgules";
                        }
                        if ($perception?->isAudio()) {
                            return "Saisir les noms à attribuer à chaque fichier audio, séparés par des virgules et dans le même ordre que les fichiers";
                        }
                    })
                    ->addActionLabel('Ajouter un stimulus'),
                SpatieMediaLibraryFileUpload::make('audio_files')
                    ->label('Fichiers audio')
                    ->collection('audio_files')
                    ->multiple()
                    ->reorderable()
                    ->downloadable()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['audio/wav', 'audio/x-wav', 'audio/mp3', 'audio/mpeg'])
                    ->visible(fn (Get $get) => Perception::tryFrom($get('perception'))?->isAudio())
                    ->helperText('Les fichiers sont réordonnables avec un glisser-déposer'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('icon')
                    ->label('Icône')
                    ->size(IconColumnSize::Medium)
                    ->icon(fn ($state) => $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durée')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('perception')
                    ->label('Perception')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('response')
                    ->label('Réponse')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('repetitions')
                    ->label('Nombre de répétitions')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mise à jour')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'view' => Pages\ViewTest::route('/{record}'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
