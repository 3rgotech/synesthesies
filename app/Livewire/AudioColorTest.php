<?php

namespace App\Livewire;

use App\Models\SubjectTest;
use App\Models\Test;
use App\Utils\Math;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Color\Hex;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AudioColorTest extends Component
{
    public Test $test;
    public ?SubjectTest $results;
    public ?array $stimuli = null;
    public ?float $totalScore = null;

    public int $totalStimuli = 0;
    public ?array $stimulus = null;
    public ?int $currentIndex = null;

    public function mount(int $testId)
    {
        $this->test = Test::find($testId);
        $existingData = $this->test->testData()->where('subject_id', Auth::guard('subjects')->id())->get()->first();
        $this->results = $existingData;
        if ($existingData === null) {
            $allStimuli = collect();
            $files = $this->test->getMedia('audio_files')->sortByDesc(fn (Media $media) => $media->order_column);
            foreach ($this->test->stimuli as $index => $stimulus) {
                /** @var Media $file */
                $file = $files->at($index);
                foreach (range(1, $this->test->repetitions) as $i) {
                    $allStimuli->push(['label' => $stimulus, 'file' => $file->getUrl(), 'type' => $file->mime_type]);
                }
            }
            $this->stimuli = $allStimuli
                ->shuffle()
                ->map(fn ($s) => ['stimulus' => $s, 'value' => null, 'duration' => null, 'evolutive' => null, 'shape' => null])
                ->all();
            $this->currentIndex = 0;
            $this->totalStimuli = count($this->stimuli);
            $this->stimulus = $this->stimuli[$this->currentIndex]['stimulus'];
        }
    }

    public function storeValue(string|array|null $value, int $duration, string $evolutive, string $shape)
    {
        $this->stimuli[$this->currentIndex]['value']    = $value;
        $this->stimuli[$this->currentIndex]['duration'] = $duration;
        $this->stimuli[$this->currentIndex]['evolutive'] = $evolutive;
        $this->stimuli[$this->currentIndex]['shape'] = $shape;
        $this->currentIndex = ($this->currentIndex + 1);

        if ($this->currentIndex >= $this->totalStimuli) {
            // store results
            $data = $this->generateData();
            $this->results = $this->test->testData()->create([
                'subject_id' => Auth::guard('subjects')->id(),
                'data'       => $data
            ]);
        } else {
            $this->stimulus = $this->stimuli[$this->currentIndex]['stimulus'];
        }
    }

    public function render()
    {
        return view('livewire.audio-color-test');
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
                $key = $item['stimulus']['label'];
                if (!array_key_exists($key, $carry)) {
                    $carry[$key] = ['responses' => [], 'durations' => [], 'evolutive' => [], 'shape' => []];
                }
                $carry[$key]['responses'][] = $this->hexToRgb($item['value']);
                $carry[$key]['durations'][] = $item['duration'];
                $carry[$key]['evolutive'][] = $item['evolutive'];
                $carry[$key]['shape'][] = $item['shape'];
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
