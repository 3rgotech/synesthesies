<?php

namespace App\Http\Livewire;

use App\Http\Livewire\QualificationWizard\InformationStep;
use App\Http\Livewire\QualificationWizard\MedicalStep;
use Spatie\LivewireWizard\Components\WizardComponent;

class QualificationWizardForm extends WizardComponent
{
    public function steps(): array
    {
        return [
            InformationStep::class,
            MedicalStep::class,
        ];
    }
}
