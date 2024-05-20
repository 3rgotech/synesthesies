<?php

namespace App\Livewire;

use App\Models\LikertTest as ModelsLikertTest;
use App\Models\LikertTestQuestion;
use App\Models\LikertTestSubject;
use App\Utils\LikertTestScore;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikertTest extends Component
{
    public ModelsLikertTest $test;

    public ?array $scale = null;
    public ?array $questions = null;
    public ?LikertTestSubject $results = null;

    public int $remainingQuestions = 0;
    public int $totalQuestions = 0;

    public function mount(int $testId)
    {
        $this->test   = ModelsLikertTest::find($testId);
        $this->scale  = $this->test->scale;
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        if ($existingData === null) {
            $this->questions = $this->test->questions
                ->map(fn (LikertTestQuestion $q) => [
                    'id'    => $q->id, 'question' => $q->question,
                    'order' => $q->order, 'response' => null
                ])
                ->when(!$this->test->fixed_order, fn ($collection) => $collection->shuffle())
                ->all();

            $this->totalQuestions     = count($this->questions);
            $this->remainingQuestions = count($this->questions);
        } else {
            $this->results = $existingData;
        }
    }

    public function storeValue(int $questionId, int $value)
    {
        $this->questions          = collect($this->questions)
            ->map(fn ($question) => $question['id'] === $questionId ? [...$question, 'response' => $value] : $question)
            ->all();
        $this->remainingQuestions = collect($this->questions)
            ->filter(fn ($question) => blank($question['response']))
            ->count();
    }

    public function storeResults()
    {
        if ($this->remainingQuestions === 0) {
            // store results
            $data = collect($this->questions)
                ->map(fn (array $question) => ['id' => $question['id'], 'response' => $question['response']])
                ->toArray();
            $this->results = $this->test->testData()->create([
                'subject_id' => Auth::guard('subjects')->id(),
                'data'       => $data,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.likert-test');
    }
}
