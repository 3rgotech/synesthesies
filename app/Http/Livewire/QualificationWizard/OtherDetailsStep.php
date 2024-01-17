<?php

namespace App\Http\Livewire\QualificationWizard;

use Spatie\LivewireWizard\Components\StepComponent;

class OtherDetailsStep extends StepComponent
{
    public array $spatialSynesthesies;
    public bool $subtitles;

    public function submit()
    {
        // $this->validate();
        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('public.qualification.steps.other-details'),
        ];
    }

    public function rules()
    {
        return [
            'spatialSynesthesies'   => ['required', 'array'],
            'spatialSynesthesies.*' => ['required', 'string', 'in:digit,month,year,other'],
            'subtitles'             => ['required', 'boolean'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'spatialSynesthesies' => 'Arrangement spatial',
            'subtitles'           => 'Visualisation des mots',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.other-details');
    }
}
