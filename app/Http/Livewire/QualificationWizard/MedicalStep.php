<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Disorder;
use App\Enum\Gender;
use App\Enum\Region;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class MedicalStep extends StepComponent
{
    public array $disorders;
    public string $diagnosis;

    public function submit()
    {
        $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('public.qualification.steps.medical'),
        ];
    }

    public function rules()
    {
        return [
            'disorders'   => ['required', 'array'],
            'disorders.*' => ['required', 'string', Rule::enum(Disorder::class)],
            'diagnosis'   => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.diagnosis')))],
        ];
    }

    public function validationAttributes()
    {
        return [
            'disorders' => 'Troubles neurodévelopppementaux',
            'diagnosis' => 'Diagnostic',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.medical');
    }
}
