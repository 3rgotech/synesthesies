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
    public string $liveInFrance;
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
            'gender'            => ['required', 'string', Rule::enum(Gender::class)],
            'birthYear'         => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'citizenship'       => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.citizenship')))],
            'liveInFrance'      => ['required', 'in:yes,no'],
            'region'            => ['required_if:liveInFrance,yes', 'nullable', 'string', Rule::enum(Region::class)],
            'language'          => ['required', 'string', Rule::in(array_keys(__('public.qualification.values.language')))],
            'email'             => ['required', 'email', 'unique:subjects,email'],
            'wantsToBeInformed' => ['sometimes', 'boolean'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'gender'            => __('public.qualification.fields.gender'),
            'birthYear'         => __('public.qualification.fields.birthYear'),
            'citizenship'       => __('public.qualification.fields.citizenship'),
            'liveInFrance'      => 'Pays',
            'region'            => 'Région',
            'language'          => __('public.qualification.fields.language'),
            'email'             => __('public.qualification.fields.email'),
            'wantsToBeInformed' => 'Tenez-moi informé',
        ];
    }

    public function render()
    {
        return view('livewire.qualificationWizard.steps.information');
    }
}
