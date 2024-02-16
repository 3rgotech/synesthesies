<?php

namespace App\Http\Controllers;

use App\Enum\Perception;
use App\Enum\Response;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Compute list of available tests depending on subject
        return view('test-list', [
            'tests' => $this->getTests(),
        ]);
    }

    public function getTests(): array
    {
        $subject = Auth::guard('subjects')->user();
        $subjectSynesthesies = $subject->synesthesies;
        return Test::all()
            ->filter(fn (Test $test) => array_key_exists($test->perception->value, $subjectSynesthesies)
                && in_array($test->response->value, $subjectSynesthesies[$test->perception->value]))
            ->map(fn (Test $test) => [
                'id'                 => $test->id,
                'title'              => $test->title,
                'description'        => $test->description,
                'duration'           => $test->duration,
                'icon'               => $test->icon,
                'user_has_completed' => $test->testData()->where('subject_id', $subject->id)->exists(),
            ])
            ->all();
    }
}
