<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Gender;
use App\Enum\Region;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;

class InformationStep extends StepComponent
{
    public string $gender;
    public int $birthYear;
    public string $citizenship;
    public string $region;
    public string $language;
    public ?string $email = null;
    public bool $wantsToBeInformed;

    public function submit()
    {
        $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('public.qualification.steps.information'),
        ];
    }

    public function rules()
    {
        return [
            'gender'            => ['string', 'nullable', Rule::enum(Gender::class)],
            'birthYear'         => ['integer', 'nullable', 'min:1900', 'max:' . date('Y')],
            'citizenship'       => ['string'],
            'region'            => ['string', Rule::enum(Region::class)],
            'language'          => ['required', 'string'],
            'email'             => ['nullable'],
            'wantsToBeInformed' => ['boolean', Rule::prohibitedIf(fn () => blank($this->email))],
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.information');
    }
}
