<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikertTestResource\Pages;
use App\Filament\Resources\LikertTestResource\RelationManagers;
use App\Models\LikertTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\TextInput::make('name')
                    ->label('Nom du test')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->columnSpanFull()
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
                    ->helperText('Doit rester activé si l\'ordre des questions influe sur le score (WBSI par exemple)')
                    ->required(),
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
                    ->reorderable()
                    ->orderColumn('order')
                    ->addActionLabel('Ajouter une question'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
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
