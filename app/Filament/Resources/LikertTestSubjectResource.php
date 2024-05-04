<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikertTestSubjectResource\Pages;
use App\Filament\Resources\LikertTestSubjectResource\RelationManagers;
use App\Forms\Components\LikertTestResults;
use App\Models\LikertTest;
use App\Models\LikertTestSubject;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LikertTestSubjectResource extends Resource
{
    protected static ?string $model = LikertTestSubject::class;

    protected static ?string $navigationIcon  = 'fas-user-check';
    protected static ?string $navigationLabel = 'Réponses Likert';
    protected static ?string $navigationGroup = 'Réponses';
    protected static ?int $navigationSort     = 10;

    protected static ?string $modelLabel       = 'Réponse';
    protected static ?string $pluralModelLabel = 'Réponses aux tests de Likert';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subject_id')
                    ->label('Identifiant du participant')
                    ->relationship('subject', 'email')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "#{$record->id} {$record->email}"),
                Forms\Components\Select::make('likertTest')
                    ->label('Test')
                    ->relationship('likertTest', 'title'),
                LikertTestResults::make('questions')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('likertTest.title')
                    ->label('Test')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.id')
                    ->label('Identifiant du participant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
            ])
            ->filters([
                SelectFilter::make('likertTest')
                    ->label('Test')
                    ->relationship('likertTest', 'title')
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
            'index' => Pages\ListLikertTestSubjects::route('/'),
            'view' => Pages\ViewLikertTestSubject::route('/{record}'),
        ];
    }

    public static function getScale($testId)
    {
        return once(function () use ($testId) {
            return LikertTest::find($testId)->scale;
        });
    }
}
