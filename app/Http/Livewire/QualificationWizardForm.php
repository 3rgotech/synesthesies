<?php

namespace App\Http\Livewire;

use App\Http\Livewire\QualificationWizard\InformationStep;
use Spatie\LivewireWizard\Components\WizardComponent;

class QualificationWizardForm extends WizardComponent
{
    public function steps(): array
    {
        return [
            InformationStep::class,
        ];
    }
}
