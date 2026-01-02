<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            // change update route
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/apps/inventory-management/public/livewire/update', $handle);
            });
            // change script route
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/apps/inventory-management/public/livewire/livewire.js', $handle);
            });
        }
    }
}
