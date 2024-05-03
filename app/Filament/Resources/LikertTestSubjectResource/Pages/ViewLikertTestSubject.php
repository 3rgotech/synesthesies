<?php

namespace App\Filament\Resources\LikertTestSubjectResource\Pages;

use App\Filament\Resources\LikertTestSubjectResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;

class ViewLikertTestSubject extends ViewRecord
{
    protected static string $resource = LikertTestSubjectResource::class;
    protected static ?string $title = "Afficher les résultats du Test de Likert";

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
