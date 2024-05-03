<?php

namespace App\Filament\Resources\LikertTestSubjectResource\Pages;

use App\Filament\Resources\LikertTestSubjectResource;
use Filament\Resources\Pages\ListRecords;

class ListLikertTestSubjects extends ListRecords
{
    protected static string $resource = LikertTestSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
