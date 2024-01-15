<?php

namespace App\Services;

class UrlLocaliser {
    public function route($route) {
        return route($route, ['locale' => app()->getLocale()]);
    }
}
