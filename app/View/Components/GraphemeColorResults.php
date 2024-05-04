<?php

namespace App\View\Components;

use App\Models\SubjectTest;
use App\Models\Test;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GraphemeColorResults extends Component
{
    public int $repetitions;
    public float $totalScore;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Test $test,
        public SubjectTest $results,
        public ?string $backUrl = null
    ) {
        $this->totalScore = collect($results->data)->pluck('score')->avg();
        $this->repetitions = collect($results->data)->pluck('responses')->map(fn ($item) => count($item))->min();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.grapheme-color-results');
    }
}
