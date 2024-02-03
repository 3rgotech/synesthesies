<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Disorder;
use App\Enum\Perception;
use App\Enum\Response;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class SynesthesiesStep extends StepComponent
{
    public array $synesthesies;
    public array $perceptions;

    public function submit()
    {
        $this->validate();
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
            'synesthesies' => ['array', function ($attribute, $value, $fail) {
                foreach ($this->perceptions as $perception) {
                    if (!array_key_exists($perception, $value) || !is_array($value[$perception]) || count($value[$perception]) === 0) {
                        $fail("Vous devez sélectionner au minimum une réponse par question");
                    }
                }
            }]
            // 'synesthesies'          => ['required_array_keys:' . $keys->join(',')],
            // ...($keys->mapWithKeys(fn ($p) => ['synesthesies.' . $p => ['array', 'min:1']])->all()),
            // 'synesthesies.*.*'      => ['required', 'string', Rule::in([...Response::values(), 'none'])],
        ];
    }

    public function validationAttributes()
    {
        return [
            'synesthesies'        => 'Perceptions',
        ];
    }

    public function messages()
    {
        return [
            'synesthesies.*.min' => 'Vous devez choisir au moins une réponse.',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.synesthesies');
    }
}
