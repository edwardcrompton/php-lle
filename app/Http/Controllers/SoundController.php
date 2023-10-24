<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoundController extends Controller
{
    public function record() {
        return view('record');
    }
}
