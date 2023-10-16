<?php

namespace App\Http\Controllers;

class SearchController extends Controller
{
    public function index(string $place) {
        return view('search', [
            'place' => $place,
            'results' => [],
        ]);
    }
}
