<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AudioController;
use Illuminate\Http\Request;

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

Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {

    Route::get('/', [AudioController::class, 'list'])
        ->name('audio-records.index');

    Route::get('/audio/list', function() {
        return redirect()->route('audio-records.index');
    });

    Route::get('/filter', function(Request $request) {
        return redirect()->route('search', ['place' => $request->place, 'locale' => app()->getLocale()]);
    })->name('filter');

    Route::get('/search/place/{place}', [SearchController::class, 'index'])
        ->name('search');

    Route::get('/audio/record', function () {
        return view('audio');
    })->name('record');

    Route::post('/audio/upload', [AudioController::class, 'upload']);

});