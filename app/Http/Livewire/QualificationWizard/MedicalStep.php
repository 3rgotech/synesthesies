<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Disorder;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class MedicalStep extends StepComponent
{
    public array $disorders = [];
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
            'disorders'   => ['array'],
            'disorders.*' => ['string', Rule::enum(Disorder::class)],
            'diagnosis'   => [Rule::excludeIf(fn () => count($this->disorders) === 0), Rule::in(array_keys(__('public.qualification.values.diagnosis')))],
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
