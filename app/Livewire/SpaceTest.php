<?php

namespace App\Livewire;

use App\Models\SubjectTest;
use App\Models\Test;
use App\Utils\Math;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Color\Hex;

class SpaceTest extends Component
{
    public Test $test;
    public ?SubjectTest $results;
    public ?array $stimuli = null;
    public ?float $totalScore = null;

    public ?array $initialSetup = null;
    public int $totalStimuli = 0;
    public ?array $allStimuli = null;
    public ?string $stimulus = null;
    public ?int $currentIndex = null;

    public function mount(int $testId)
    {
        $this->test = Test::find($testId);
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        $this->results = $existingData;
        if ($existingData === null) {
            $this->allStimuli = $this->test->stimuli;
            $this->stimuli = Collection::times(1, fn () => $this->test->stimuli)
                ->flatten()
                ->shuffle()
                ->map(fn ($s) => ['stimulus' => $s, 'value' => null, 'duration' => null])
                ->all();
            $this->currentIndex = 0;
            $this->totalStimuli = count($this->stimuli);
            $this->stimulus = strval($this->stimuli[$this->currentIndex]['stimulus']);
        }
    }

    public function storeInitialSetup(array $values, int $duration)
    {
        $this->initialSetup = [
            'responses' => $values,
            'duration'  => $duration
        ];
    }

    public function storeValue(array $value, int $duration)
    {
        $this->stimuli[$this->currentIndex]['value']    = $value;
        $this->stimuli[$this->currentIndex]['duration'] = $duration;
        $this->currentIndex = ($this->currentIndex + 1);

        if ($this->currentIndex >= $this->totalStimuli) {
            // store results
            $data = $this->generateData();
            $this->results = $this->test->testData()->create([
                'subject_id' => Auth::guard('subjects')->id(),
                'data'       => $data
            ]);
        } else {
            $this->stimulus = strval($this->stimuli[$this->currentIndex]['stimulus']);
        }
    }

    protected function generateData(): array
    {
        $data = collect($this->stimuli)
            ->reduce(function ($carry, $item) {
                if (!array_key_exists($item['stimulus'], $carry)) {
                    $carry[$item['stimulus']] = ['responses' => [], 'durations' => []];

                    // Get the data from the initial setup
                    if (array_key_exists($item['stimulus'], $this->initialSetup['responses'])) {
                        $carry[$item['stimulus']]['responses'][] = $this->initialSetup['responses'][$item['stimulus']];
                        $carry[$item['stimulus']]['durations'][] = $this->initialSetup['duration'] / count($this->initialSetup['responses']);
                    }
                }

                $carry[$item['stimulus']]['responses'][] = $item['value'];
                $carry[$item['stimulus']]['durations'][] = $item['duration'];
                return $carry;
            }, []);
        dump($data);
        return array_map(function ($item) {
            if (in_array(null, $item['responses'])) {
                // User has selected "no color" at least once
                $item['score'] = null;
            } else {
                $item['score'] = $this->computeScore($item['responses']);
            }
            return $item;
        }, $data);
    }

    protected function computeScore(array $responses): float
    {
        return collect(Math::combinations($responses, 2))
            ->map(function ($combination) {
                return Math::distance(...$combination);
            })
            ->avg();
    }

    public function render()
    {
        return view('livewire.space-test');
    }
}
