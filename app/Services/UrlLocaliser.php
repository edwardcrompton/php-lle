<?php

namespace App\Services;

class UrlLocaliser {
    public function route($route) {
        return route($route, ['locale' => app()->getLocale()]);
    }

    public function redirect($route) {
        return redirect()->route($route, ['locale' => app()->getLocale()]);
    }
}
