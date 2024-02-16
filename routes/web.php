<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestListController;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('qualification', QualificationController::class)->name('qualification');
Route::get('login', Login::class)->name('login');

Route::middleware('auth:subjects')->group(function () {
    Route::get('test-list', TestListController::class)->name('test-list');
    Route::get('test/{test}', TestController::class)->name('test');
    Route::get('logout', LogoutController::class)->name('logout');
});

Route::view('legal', 'legal')->name('legal');
Route::view('privacy', 'privacy')->name('privacy');
