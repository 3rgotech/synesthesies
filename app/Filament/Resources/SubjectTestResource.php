<?php

namespace App\Filament\Resources;

use App\Enum\Perception;
use App\Filament\Resources\SubjectTestResource\Pages;
use App\Filament\Resources\SubjectTestResource\RelationManagers;
use App\Forms\Components\TestResults;
use App\Models\SubjectTest;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectTestResource extends Resource
{
    protected static ?string $model = SubjectTest::class;

    protected static ?string $navigationIcon  = 'fas-user-doctor';
    protected static ?string $navigationLabel = 'Réponses Synesthésiques';
    protected static ?string $navigationGroup = 'Réponses';
    protected static ?int $navigationSort     = 10;

    protected static ?string $modelLabel       = 'Réponse';
    protected static ?string $pluralModelLabel = 'Réponses aux tests de Synesthésie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subject_id')
                    ->label('Identifiant du participant')
                    ->relationship('subject', 'email')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "#{$record->id} {$record->email}"),
                Forms\Components\Select::make('test_id')
                    ->relationship('test', 'title')
                    ->required(),
                Forms\Components\Select::make('test.perception')
                    ->label('Perception')
                    ->relationship('test', 'perception')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->perception->getLabel())
                    ->required(),
                Forms\Components\Select::make('test.response')
                    ->label('Réponse')
                    ->relationship('test', 'response')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->response->getLabel())
                    ->required(),
                TestResults::make('questions')
                    ->label('Réponses')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test.title')
                    ->label('Test')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.id')
                    ->label('Identifiant du participant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('test.perception')
                    ->label('Perception')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('test.response')
                    ->label('Réponse')
                    ->searchable()
                    ->sortable(),
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
                SelectFilter::make('test')
                    ->label('Test')
                    ->relationship('test', 'title')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('test')
                    ->label('Test')
                    ->relationship('test', 'title')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('subject')
                    ->label('Participant')
                    ->relationship('subject', 'id'),
                Filter::make('created_at')
                    ->label('Date')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Fait après'),
                        DatePicker::make('created_until')
                            ->label('Fait avant'),
                    ])
                    ->columns(2)
                    ->columnSpan(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListSubjectTests::route('/'),
            'view'  => Pages\ViewSubjectTest::route('/{record}'),
        ];
    }
}
