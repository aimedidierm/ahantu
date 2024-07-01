<?php

namespace Ahantu;

use Illuminate\Support\ServiceProvider;

class LocationsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Console\CreateLocations::class,
        ]);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->publishes([
            __DIR__ . '/Database/Seeders' => database_path('seeders')
        ], 'seeders');
    }
}
