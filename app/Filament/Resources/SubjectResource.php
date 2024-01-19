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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('disorders')
                            ->label('Troubles Neurodéveloppementaux')
                            ->multiple()
                            ->options(Disorder::class)
                            ->required(),
                        Forms\Components\Radio::make('diagnosis')
                            ->required()
                            ->options(__('public.qualification.values.diagnosis')),
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
                        Forms\Components\TextArea::make('has_changed_details')
                            ->label('Détails des changements')
                            ->columnSpanFull()
                            ->hidden(fn ($get) => !$get('has_changed')),
                        Forms\Components\Toggle::make('problematic')
                            ->label('Problématique ?')
                            ->live(),
                        Forms\Components\TextArea::make('problematic_details')
                            ->label('Détails de la problématique')
                            ->columnSpanFull()
                            ->hidden(fn ($get) => !$get('problematic')),
                        Forms\Components\Textarea::make('comments')
                            ->label('Commentaires')
                            ->nullable()
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
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Genre'),
                Tables\Columns\TextColumn::make('birth_year')
                    ->label('Année de naissance')
                    ->numeric()
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
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
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
            'create' => Pages\CreateSubject::route('/create'),
            'view'   => Pages\ViewSubject::route('/{record}'),
        ];
    }
}
