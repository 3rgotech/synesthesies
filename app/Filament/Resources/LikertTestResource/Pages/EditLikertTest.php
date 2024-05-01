<?php

namespace App\Filament\Resources\LikertTestResource\Pages;

use App\Filament\Resources\LikertTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLikertTest extends EditRecord
{
    protected static string $resource = LikertTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
