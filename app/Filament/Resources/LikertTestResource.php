<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikertTestResource\Pages;
use App\Filament\Resources\LikertTestResource\RelationManagers;
use App\Models\LikertTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn\IconColumnSize;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LikertTestResource extends Resource
{
    protected static ?string $model = LikertTest::class;

    protected static ?string $navigationIcon   = 'fas-clipboard-list';
    protected static ?string $navigationGroup  = 'Paramètres';
    protected static ?int $navigationSort      = 20;
    protected static ?string $navigationLabel  = 'Tests de Personnalité';
    protected static ?string $modelLabel       = 'Test de Personnalité';
    protected static ?string $pluralModelLabel = 'Tests de Personnalité';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->label('Durée')
                    ->required()
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
                Forms\Components\RichEditor::make('introduction')
                    ->label('Description')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('scale')
                    ->label('Echelle de réponses')
                    ->columnSpanFull()
                    ->minItems(1)
                    ->simple(
                        Forms\Components\TextInput::make('value')
                            ->label('Intitulé')
                            ->required()
                            ->maxLength(1000)
                    )
                    ->mutateDehydratedStateUsing(function ($state) {
                        return collect($state)
                            ->pluck('value')
                            ->values()
                            ->filter(fn ($value) => filled($value))
                            ->mapWithKeys(fn ($value, $key) => [($key + 1) => $value])
                            ->toArray();
                    })
                    ->addActionLabel('Ajouter une réponse à l\'échelle'),
                Forms\Components\Toggle::make('fixed_order')
                    ->label('Ordre fixe des questions')
                    ->columnSpanFull()
                    ->helperText('Doit rester activé si l\'ordre des questions influe sur le score (OSIVQ par exemple)')
                    ->reactive()
                    ->required(),
                Forms\Components\RichEditor::make('score_explanation')
                    ->label('Explication du calcul de score')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('questions')
                    ->label('Questions')
                    ->relationship('questions')
                    ->columnSpanFull()
                    ->minItems(1)
                    ->simple(
                        Forms\Components\Textarea::make('question')
                            ->label('Intitulé de la question')
                            ->required()
                            ->maxLength(1000)
                    )
                    ->reorderable(fn (Get $get) => !$get('fixed_order'))
                    ->orderColumn('order')
                    ->addActionLabel('Ajouter une question'),
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
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durée')
                    ->searchable(),
                Tables\Columns\TextColumn::make('questions_count')
                    ->counts('questions')
                    ->label('Nombre de questions'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mise à jour')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListLikertTests::route('/'),
            'create' => Pages\CreateLikertTest::route('/create'),
            'view' => Pages\ViewLikertTest::route('/{record}'),
            'edit' => Pages\EditLikertTest::route('/{record}/edit'),
        ];
    }
}
