<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AudioController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search/{place}', [SearchController::class, 'index']);

Route::get('/audio/record', function () {
    return view('audio');
});

Route::post('/audio/upload', [AudioController::class, 'uploadAudio']);

Route::get('/audio/list', [AudioController::class, 'listAudio'])->name('audio-records.index');
;