<?php

namespace App\Livewire;

use App\Models\SubjectTest;
use App\Models\Test;
use App\Utils\Math;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Color\Hex;

class WordColorTest extends Component
{
    public Test $test;
    public ?SubjectTest $results;
    public ?array $stimuli = null;
    public ?float $totalScore = null;

    public int $totalStimuli = 0;
    public ?string $stimulus = null;
    public ?int $currentIndex = null;

    public function mount(int $testId)
    {
        $this->test = Test::find($testId);
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        $this->results = $existingData;
        if ($existingData === null) {
            $this->stimuli = Collection::times($this->test->repetitions, fn () => $this->test->stimuli)
                ->flatten()
                ->shuffle()
                ->map(fn ($s) => ['stimulus' => $s, 'value' => null, 'duration' => null])
                ->all();
            $this->currentIndex = 0;
            $this->totalStimuli = count($this->stimuli);
            $this->stimulus = strval($this->stimuli[$this->currentIndex]['stimulus']);
        }
    }

    public function storeValue(string|array|null $value, int $duration)
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

    public function render()
    {
        return view('livewire.word-color-test');
    }

    protected function hexToRgb(string|array|null $hex): ?array
    {
        if (is_null($hex)) {
            return null;
        } else {
            $rgb = Hex::fromString($hex)->toRgb();
            return [$rgb->red(), $rgb->green(), $rgb->blue()];
        }
    }

    protected function generateData(): array
    {
        $data = collect($this->stimuli)
            ->reduce(function ($carry, $item) {
                if (!array_key_exists($item['stimulus'], $carry)) {
                    $carry[$item['stimulus']] = ['responses' => [], 'durations' => []];
                }
                $carry[$item['stimulus']]['responses'][] = $this->hexToRgb($item['value']);
                $carry[$item['stimulus']]['duration'][] = $item['duration'];
                return $carry;
            }, []);
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
}
