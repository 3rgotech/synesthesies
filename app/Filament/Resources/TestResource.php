<?php

namespace App\Filament\Resources;

use App\Enum\Perception;
use App\Enum\Response;
use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'fas-clipboard-question';
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?int $navigationSort     = 15;

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
                Forms\Components\Select::make('perception')
                    ->label('Perception')
                    ->options(Perception::class)
                    ->required(),
                Forms\Components\Select::make('response')
                    ->label('Réponse')
                    ->options(Response::class)
                    ->required(),
                Forms\Components\TextInput::make('stimuli')
                    ->required()
                    ->columnSpanFull()
                    ->afterStateHydrated(function ($component, $state) {
                        $component->state(implode(', ', $state));
                    })
                    ->dehydrateStateUsing(fn (string $state) => array_filter(array_map('trim', explode(',', $state))))
                    ->helperText("Séparer les stimuli par des virgules"),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durée')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perception')
                    ->label('Perception')
                    ->searchable(),
                Tables\Columns\TextColumn::make('response')
                    ->label('Réponse')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
