<?php

namespace App\Providers;

use App\Http\Livewire\QualificationWizard\InformationStep;
use App\Http\Livewire\QualificationWizard\MedicalStep;
use App\Http\Livewire\QualificationWizard\MiscStep;
use App\Http\Livewire\QualificationWizard\OtherDetailsStep;
use App\Http\Livewire\QualificationWizard\SynesthesiesStep;
use App\Http\Livewire\QualificationWizardForm;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('qualification-wizard', QualificationWizardForm::class);
        Livewire::component('information-step', InformationStep::class);
        Livewire::component('medical-step', MedicalStep::class);
        Livewire::component('synesthesies-step', SynesthesiesStep::class);
        Livewire::component('other-details-step', OtherDetailsStep::class);
        Livewire::component('misc-step', MiscStep::class);
    }
}
