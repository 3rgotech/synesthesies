<?php

namespace App\Http\Controllers;

use App\Enum\Perception;
use App\Enum\Response;
use App\Models\LikertTest;
use Illuminate\Http\Request;

class LikertTestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, LikertTest $test)
    {
        $testComponent = 'likert-test';

        return view('test', [
            'testComponent' => $testComponent,
            'testId'        => $test->id
        ]);
    }
}
