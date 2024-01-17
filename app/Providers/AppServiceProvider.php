<?php

namespace App\Providers;

use App\Http\Livewire\QualificationWizard\InformationStep;
use App\Http\Livewire\QualificationWizard\MedicalStep;
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
    }
}
