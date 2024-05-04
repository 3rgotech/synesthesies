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
        return view('test', [
            'testComponent' => $test->getTestComponent(),
            'testId'        => $test->id
        ]);
    }
}
