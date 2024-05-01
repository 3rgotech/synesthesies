<?php

namespace App\Filament\Resources\LikertTestResource\Pages;

use App\Filament\Resources\LikertTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLikertTests extends ListRecords
{
    protected static string $resource = LikertTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
