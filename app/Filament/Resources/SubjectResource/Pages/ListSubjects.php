<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
