<?php

namespace App\Http\Livewire;

use App\Enum\Disorder;
use App\Enum\Perception;
use App\Http\Livewire\QualificationWizard\InformationStep;
use App\Http\Livewire\QualificationWizard\MedicalStep;
use App\Http\Livewire\QualificationWizard\MiscStep;
use App\Http\Livewire\QualificationWizard\OtherDetailsStep;
use App\Http\Livewire\QualificationWizard\SynesthesiesStep;
use Spatie\LivewireWizard\Components\WizardComponent;

class QualificationWizardForm extends WizardComponent
{
    public function steps(): array
    {
        return [
            InformationStep::class,
            MedicalStep::class,
            SynesthesiesStep::class,
            OtherDetailsStep::class,
            MiscStep::class
        ];
    }

    public function initialState(): array
    {
        return [
            'synesthesies-step' => [
                'perceptions'  => collect(Perception::cases())->map(fn (Perception $perception) => $perception->value)->toArray(),
                'synesthesies' => collect(Perception::cases())->mapWithKeys(fn (Perception $perception) => [$perception->value => ['none']])->toArray()
            ],
            'other-details-step' => [
                'spatialSynesthesies' => [],
            ]
        ];
    }
}
