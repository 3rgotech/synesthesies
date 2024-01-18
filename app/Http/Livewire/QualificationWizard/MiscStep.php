<?php

namespace App\Http\Livewire\QualificationWizard;

use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class MiscStep extends StepComponent
{
    public ?string $alwaysExisted;
    public ?string $hasChanged;
    public ?string $hasChangedDetails;
    public ?string $problematic;
    public ?string $problematicDetails;
    public ?string $comments;

    public function submit()
    {
        $this->validate();

        ray($this->state()->all());
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('public.qualification.steps.misc'),
        ];
    }

    public function rules()
    {
        return [
            'alwaysExisted'      => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.boolean')))],
            'hasChanged'         => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.boolean')))],
            'hasChangedDetails'  => ['required_if:hasChanged,yes', 'nullable', 'string'],
            'problematic'        => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.boolean')))],
            'problematicDetails' => ['required_if:problematic,yes', 'nullable', 'string'],
            'comments'           => ['nullable', 'string'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'alwaysExisted'      => 'Souvenir',
            'hasChanged'         => 'Changements',
            'hasChangedDetails'  => 'Détails des changements',
            'problematic'        => 'Gêne',
            'problematicDetails' => 'Détails de la gêne',
            'comments'           => 'Autres éléments',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.misc');
    }
}
