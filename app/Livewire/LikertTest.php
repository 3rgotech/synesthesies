<?php

namespace App\Livewire;

use App\Models\LikertTest as ModelsLikertTest;
use App\Models\LikertTestQuestion;
use App\Models\Test;
use App\Utils\LikertTestScore;
use App\Utils\Math;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Color\Hex;

class LikertTest extends Component
{
    public ModelsLikertTest $test;
    public ?array $scale     = null;
    public ?array $questions = null;
    public ?array $results   = null;
    public ?array $score     = null;

    public int $remainingQuestions = 0;
    public int $totalQuestions     = 0;

    public function mount(int $testId)
    {
        $this->test = ModelsLikertTest::find($testId);
        $this->scale = $this->test->scale;
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        if ($existingData === null) {
            $this->questions = $this->test->questions
                ->map(fn (LikertTestQuestion $q) => ['id' => $q->id, 'question' => $q->question, 'order' => $q->order, 'response' => null])
                ->when($this->test->fixed_order, fn ($collection) => $collection->shuffle())
                ->all();

            $this->totalQuestions = count($this->questions);
            $this->remainingQuestions = count($this->questions);
        } else {
            $this->results = $existingData->data;
            if (filled($this->test->score_computation_method)) {
                $method = $this->test->score_computation_method;
                $this->score = LikertTestScore::$method($existingData->data);
            }
        }
    }

    public function storeValue(int $questionId, int $value)
    {
        $this->questions = collect($this->questions)
            ->map(fn ($question) => $question['id'] === $questionId ? [...$question, 'response' => $value] : $question)
            ->all();
        $this->questions[$this->currentIndex]['response'] = $value;
        $this->remainingQuestions = collect($this->questions)
            ->filter(fn ($question) => blank($question['response']))
            ->count();

        if ($this->remainingQuestions === 0) {
            // store results
            $data = collect($this->questions)
                ->map(fn (array $question) => ['id' => $question['id'], 'response' => $question['response']])
                ->toArray();
            $this->test->testData()->create([
                'subject_id' => Auth::guard('subjects')->id(),
                'data'       => $data
            ]);
            $this->results = $data;
            if (filled($this->test->score_computation_method)) {
                $method = $this->test->score_computation_method;
                $this->score = LikertTestScore::$method($data);
            }
        }
    }

    public function render()
    {
        return view('livewire.likert-test');
    }
}
