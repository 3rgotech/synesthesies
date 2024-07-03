<?php

namespace App\Http\Livewire\QualificationWizard;

use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class OtherDetailsStep extends StepComponent
{
    public ?string $spatial;
    public array $spatialSynesthesies;
    public ?string $subtitles;

    public function submit()
    {
        $this->validate();
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
            'spatial'               => ['required', 'string', 'in:yes,no'],
            'spatialSynesthesies'   => ['array', 'required_if:spatial,yes'],
            'spatialSynesthesies.*' => ['required', 'string', 'in:digit,month,year,other'],
            'subtitles'             => ['required', 'string', 'in:yes,no'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'spatial'             => 'Arrangement spatial',
            'spatialSynesthesies' => 'Arrangement spatial 2',
            'subtitles'           => 'Visualisation des mots',
        ];
    }

    public function messages()
    {
        return [
            'spatialSynesthesies.required_if' => 'Vous devez choisir au moins un type d\'arrangement spatial.',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.other-details');
    }
}
