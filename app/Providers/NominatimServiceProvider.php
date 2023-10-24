<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NominatimLaravel\Content\Nominatim;

class NominatimServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Nominatim::class, function($app) {
            return new Nominatim('http://nominatim.openstreetmap.org/');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
