<?php

namespace App\View\Components;

use App\Models\LikertTest;
use App\Models\LikertTestSubject;
use App\Utils\LikertTestScore;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LikertTestResults extends Component
{
    public array $resultsData;
    public ?float $score = null;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public LikertTest $test,
        public LikertTestSubject $results,
        public ?string $backUrl = null
    ) {
        $this->resultsData = collect($results->data)->pluck('response', 'id')->all();
        if (filled($method = $test->score_computation_method)) {
            $this->score = LikertTestScore::$method($results->data);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.likert-test-results');
    }
}
