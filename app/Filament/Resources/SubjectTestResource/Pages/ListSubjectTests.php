<?php

namespace App\Filament\Resources\SubjectTestResource\Pages;

use App\Filament\Resources\SubjectTestResource;
use Filament\Resources\Pages\ListRecords;

class ListSubjectTests extends ListRecords
{
    protected static string $resource = SubjectTestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
