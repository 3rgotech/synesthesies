<?php

namespace App\Filament\Resources\LikertTestResource\Pages;

use App\Filament\Resources\LikertTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLikertTest extends ViewRecord
{
    protected static string $resource = LikertTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
