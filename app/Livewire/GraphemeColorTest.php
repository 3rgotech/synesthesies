<?php

namespace App\Livewire;

use App\Models\Test;
use App\Utils\Math;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Color\Hex;

class GraphemeColorTest extends Component
{
    public Test $test;
    public ?array $stimuli = null;
    public ?array $results = null;
    public ?float $totalScore = null;

    public int $totalStimuli = 0;
    public ?string $stimulus = null;
    public ?int $currentIndex = null;

    public function mount(int $testId)
    {
        $this->test = Test::find($testId);
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        if ($existingData === null) {
            $this->stimuli = Collection::times(3, fn () => $this->test->stimuli)
                ->flatten()
                ->shuffle()
                ->map(fn ($s) => ['stimulus' => $s, 'value' => null, 'duration' => null])
                ->all();
            $this->currentIndex = 0;
            $this->totalStimuli = count($this->stimuli);
            $this->stimulus = strval($this->stimuli[$this->currentIndex]['stimulus']);
        } else {
            $this->results = $existingData->data;
            $this->totalScore = collect($existingData->data)->pluck('score')->avg();
        }
    }

    public function storeValue(string $value, int $duration)
    {
        $this->stimuli[$this->currentIndex]['value']    = $value;
        $this->stimuli[$this->currentIndex]['duration'] = $duration;
        $this->currentIndex = ($this->currentIndex + 1);

        if ($this->currentIndex >= $this->totalStimuli) {
            // store results
            $data = $this->generateData($this->stimuli);
            $this->test->testData()->create([
                'subject_id' => Auth::guard('subjects')->id(),
                'data'       => $data
            ]);
            $this->results = $data;
            $this->totalScore = collect($data)->pluck('score')->avg();
        } else {
            $this->stimulus = strval($this->stimuli[$this->currentIndex]['stimulus']);
        }
    }

    public function render()
    {
        return view('livewire.grapheme-color-test');
    }

    protected function hexToRgb(string $hex): array
    {
        $rgb = Hex::fromString($hex)->toRgb();
        return [$rgb->red(), $rgb->green(), $rgb->blue()];
    }

    protected function generateData(array $stimuli): array
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
        $data = array_map(function ($item) {
            $item['score'] = $this->computeScore($item['responses']);
            return $item;
        }, $data);
        ray($data);
        return $data;
    }

    protected function computeScore(array $responses): float
    {
        return collect(Math::combinations($responses, 2))
            ->map(fn ($combination) => Math::distance(...$combination))
            ->avg();
    }
}
