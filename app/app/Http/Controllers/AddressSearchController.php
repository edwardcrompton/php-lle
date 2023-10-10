<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressSearchController extends Controller
{
    public function index() {
        return view('search');
    }
}
