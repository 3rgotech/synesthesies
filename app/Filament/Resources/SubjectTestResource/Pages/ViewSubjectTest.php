<?php

namespace App\Filament\Resources\SubjectTestResource\Pages;

use App\Filament\Resources\SubjectTestResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSubjectTest extends ViewRecord
{
    protected static string $resource = SubjectTestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
