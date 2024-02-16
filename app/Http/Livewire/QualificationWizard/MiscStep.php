<?php

namespace App\Http\Livewire\QualificationWizard;

use App\Enum\Disorder;
use App\Enum\Gender;
use App\Enum\Perception;
use App\Enum\Region;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
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

        $state = $this->state()->all();

        $disorders = collect($state['medical-step']['disorders'])
            ->map(fn ($d) => Disorder::tryFrom($d))
            ->filter(fn ($d) => filled($d))
            ->all();
        $synesthesies = collect($state['synesthesies-step']['synesthesies'])
            ->map(fn ($responses) => array_unique(array_filter($responses, fn ($response) => filled($response) && $response !== 'none')))
            ->filter(fn ($responses) => count($responses) > 0)
            ->all();

        // Save form data
        $subject = Subject::create([
            'email'                => $state['information-step']['email'],
            'gender'               => Gender::tryFrom($state['information-step']['gender']),
            'birth_year'           => $state['information-step']['birthYear'],
            'citizenship'          => $state['information-step']['citizenship'],
            'region'               => $state['information-step']['liveInFrance'] === 'yes' ? Region::tryFrom($state['information-step']['region']) : null,
            'language'             => $state['information-step']['language'],
            'keep_informed'        => $state['information-step']['wantsToBeInformed'],
            'disorders'            => $disorders,
            'diagnosis'            => $state['medical-step']['diagnosis'],
            'other_disorders'      => $state['medical-step']['otherDisorders'] ?? '',
            'synesthesies'         => $synesthesies,
            'spatial_synesthesies' => $state['other-details-step']['spatial'] === 'yes' ? $state['other-details-step']['spatialSynesthesies'] : [],
            'subtitles'            => $state['other-details-step']['subtitles'] === 'yes',
            'always_existed'       => $state['misc-step']['alwaysExisted'] === 'yes',
            'has_changed'          => $state['misc-step']['hasChanged'] === 'yes',
            'has_changed_details'  => $state['misc-step']['hasChanged'] === 'yes' ? $state['misc-step']['hasChangedDetails'] : '',
            'problematic'          => $state['misc-step']['problematic'] === 'yes',
            'problematic_details'  => $state['misc-step']['problematic'] === 'yes' ? $state['misc-step']['problematicDetails'] : '',
            'comments'             => $state['misc-step']['comments'] ?? '',
        ]);

        // Login and redirect
        Auth::guard('subjects')->login($subject, true);
        return $this->redirectRoute('test-list');
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
