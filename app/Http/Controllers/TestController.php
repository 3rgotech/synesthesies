<?php

namespace App\Http\Controllers;

use App\Enum\Perception;
use App\Enum\Response;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Test $test)
    {
        $testComponent = null;
        if ($test->response === Response::COLOR) {
            if ($test->perception === Perception::DIGIT || $test->perception === Perception::LETTER) {
                $testComponent = 'grapheme-color-test';
            }
        }

        return view('test', [
            'testComponent' => $testComponent,
            'testId'        => $test->id
        ]);
    }
}
