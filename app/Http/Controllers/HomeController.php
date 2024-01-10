<?php

namespace App\Http\Controllers;

use App\Settings\TextContentSettings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TextContentSettings $textSettings)
    {
        $texts = [
            'main'    => $textSettings->homepage_main_block,
            'blocks'  => $textSettings->homepage_blocks,
            'consent' => $textSettings->consent_text,
        ];
        return view('home', compact('texts'));
    }
}
