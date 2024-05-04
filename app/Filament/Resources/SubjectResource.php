<?php

namespace App\Filament\Resources;

use App\Enum\Disorder;
use App\Enum\Gender;
use App\Enum\Perception;
use App\Enum\Region;
use App\Enum\Response;
use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon  = 'fas-user-tag';
    protected static ?string $navigationLabel = 'Participants';
    protected static ?string $navigationGroup = 'Réponses';
    protected static ?int $navigationSort     = 1;

    protected static ?string $modelLabel       = 'Participant';
    protected static ?string $pluralModelLabel = 'Participants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->label('Identifiant')
                            ->email()
                            ->readOnly()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->label('Genre')
                            ->options(Gender::class)
                            ->required(),
                        Forms\Components\TextInput::make('birth_year')
                            ->label('Année de naissance')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('citizenship')
                            ->label('Nationalité')
                            ->required()
                            ->options(__('public.qualification.values.citizenship')),
                        Forms\Components\Select::make('region')
                            ->label('Localisation')
                            ->placeholder('Hors France')
                            ->options(Region::class)
                            ->nullable()
                            ->hidden(fn ($operation, $record) => $operation === 'view' && $record->region === null),
                        Forms\Components\TextInput::make('region')
                            ->label('Localisation')
                            ->placeholder('Hors France')
                            ->nullable()
                            ->hidden(fn ($operation, $record) => $operation !== 'view' || $record->region !== null),
                        Forms\Components\Select::make('language')
                            ->label('Langue')
                            ->required()
                            ->options(__('public.qualification.values.citizenship')),
                        Forms\Components\Toggle::make('keep_informed')
                            ->label('Tenir informé ?')
                            ->required(),
                    ]),
                Section::make('Informations Médicales')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Repeater::make('disordersWithDiagnosis')
                            ->dehydrateStateUsing(fn ($state) => array_values($state))
                            ->columns([
                                'default' => 1,
                                'lg'      => 2
                            ])
                            ->schema([
                                Forms\Components\Select::make('disorder')
                                    ->label('Trouble')
                                    ->required()
                                    ->options(Disorder::class),
                                Forms\Components\Select::make('diagnosis')
                                    ->label('Diagnostic')
                                    ->required()
                                    ->options(__('public.qualification.values.diagnosis'))
                            ])
                            ->label('Troubles Neurodéveloppementaux'),
                        Forms\Components\Textarea::make('other_disorders')
                            ->label('Autres troubles')
                            ->default('')
                            ->placeholder('')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
                Section::make('Synesthésies')
                    ->columns(2)
                    ->schema([
                        Tabs::make('synesthesies')
                            ->tabs(
                                collect(Perception::cases())
                                    ->map(
                                        fn (Perception $p) => Tabs\Tab::make($p->getLabel())
                                            ->badge(fn ($record) => count($record->synesthesies[$p->value] ?? []) ?: null)
                                            ->schema([
                                                Forms\Components\CheckboxList::make('synesthesies.' . $p->value)
                                                    // ->multiple()
                                                    ->hiddenLabel()
                                                    ->options(Response::class)
                                                    ->columns(4)
                                            ])
                                    )
                                    ->all()
                            )
                            ->columnSpanFull(),
                        Forms\Components\CheckboxList::make('spatialSynesthesies')
                            ->label('Associations Spatiales')
                            ->options(__('public.qualification.values.spatial'))
                            ->columns(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('subtitles')
                            ->label('Visualisation textuelle de la parole ?')
                            ->required(),
                        Forms\Components\Toggle::make('always_existed')
                            ->label('Toujours existé ?'),
                        Forms\Components\Toggle::make('has_changed')
                            ->label('A changé dans le temps ?')
                            ->live(),
                        Forms\Components\Textarea::make('has_changed_details')
                            ->label('Détails des changements')
                            ->columnSpanFull()
                            ->hidden(fn ($get) => !$get('has_changed')),
                        Forms\Components\Toggle::make('problematic')
                            ->label('Problématique ?')
                            ->live(),
                        Forms\Components\Textarea::make('problematic_details')
                            ->label('Détails de la problématique')
                            ->columnSpanFull()
                            ->hidden(fn ($get) => !$get('problematic')),
                        Forms\Components\Textarea::make('comments')
                            ->label('Commentaires')
                            ->default('')
                            ->placeholder('')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Identifiant')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Genre'),
                Tables\Columns\TextColumn::make('birth_year')
                    ->label('Année de naissance')
                    ->numeric(thousandsSeparator: '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('citizenship')
                    ->label('Nationalité')
                    ->formatStateUsing(fn ($state) => __('public.qualification.values.citizenship.' . $state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->label('Localisation')
                    ->placeholder('Hors France')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->label('Langue maternelle')
                    ->formatStateUsing(fn ($state) => __('public.qualification.values.language.' . $state))
                    ->searchable(),
                Tables\Columns\IconColumn::make('keep_informed')
                    ->label('Tenir informé ?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->label('Genre')
                    ->options(Gender::class),
                SelectFilter::make('citizenship')
                    ->label('Nationalité')
                    ->options(__('public.qualification.values.citizenship')),
                SelectFilter::make('language')
                    ->label('Langue maternelle')
                    ->options(__('public.qualification.values.language')),
                Filter::make('birth_year')
                    ->label('Date')
                    ->form([
                        Forms\Components\TextInput::make('born_from')
                            ->label('Né après')
                            ->numeric()
                            ->default(1900)
                            ->minValue(1900)
                            ->maxValue(date('Y')),
                        Forms\Components\TextInput::make('born_until')
                            ->label('Né avant')
                            ->numeric()
                            ->default(date('Y'))
                            ->minValue(1900)
                            ->maxValue(date('Y')),
                    ])
                    // ->columns(2)
                    // ->columnSpan(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['born_from'],
                                fn (Builder $query, $year): Builder => $query->where('birth_year', '>=', $year),
                            )
                            ->when(
                                $data['born_until'],
                                fn (Builder $query, $year): Builder => $query->where('birth_year', '<=', $year),
                            );
                    }),
                Filter::make('created_at')
                    ->label('Date')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Créé après'),
                        DatePicker::make('created_until')
                            ->label('Créé avant'),
                    ])
                    // ->columns(2)
                    // ->columnSpan(2)
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
                Tables\Actions\ViewAction::make()
                    ->label('Informations'),
                Tables\Actions\Action::make('tests')
                    ->label('Tests Synesthétiques')
                    ->icon('fas-user-doctor')
                    ->color(Color::Green)
                    ->url(fn ($record) => route('filament.admin.resources.subject-tests.index', ['tableFilters[subject][value]' => $record->id])),
                Tables\Actions\Action::make('likert')
                    ->label('Tests de Personnalité')
                    ->icon('fas-user-check')
                    ->color(Color::Blue)
                    ->url(fn ($record) => route('filament.admin.resources.likert-test-subjects.index', ['tableFilters[subject][value]' => $record->id])),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Action::make('mailingList')
                    ->label('Mailing List')
                    ->color(Color::Blue)
                    ->icon('fas-envelope')
                    ->form([
                        Forms\Components\Textarea::make('mailing')
                            ->label('Participants souhaitant être informés')
                            ->readOnly()
                            ->rows(6)
                            ->default(self::mailingList())
                            ->hintAction(
                                CopyAction::make()
                                    ->label('Tout copier')
                                    ->copyable(self::mailingList())
                            ),
                        Forms\Components\Textarea::make('mailing_all')
                            ->label('Tous les participants')
                            ->readOnly()
                            ->rows(6)
                            ->default(self::mailingList(includeAll: true))
                            ->hintAction(
                                CopyAction::make()
                                    ->label('Tout copier')
                                    ->copyable(self::mailingList(includeAll: true))
                            ),
                    ])
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Fermer')
                    ->modalFooterActionsAlignment(Alignment::End)
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
            'index'  => Pages\ListSubjects::route('/'),
            'view'   => Pages\ViewSubject::route('/{record}'),
        ];
    }

    public static function mailingList(bool $includeAll = false): string
    {
        return Subject::query()
            ->when(!$includeAll, fn ($query) => $query->where('keep_informed', true))
            ->pluck('email')
            ->join(';');
    }
}
