<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Disorder;
use App\Enum\Response;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class SynesthesiesStep extends StepComponent
{
    public array $synesthesies;

    public function submit()
    {
        // $this->validate();
        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('public.qualification.steps.synesthesies'),
        ];
    }

    public function rules()
    {
        return [
            'synesthesies'          => ['required', 'array'],
            'synesthesies.*'        => ['required', 'array'],
            'synesthesies.*.*'      => ['required', 'string', Rule::in([...Response::values(), 'none'])],
        ];
    }

    public function validationAttributes()
    {
        return [
            'synesthesies'        => 'Perceptions',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.synesthesies');
    }
}
