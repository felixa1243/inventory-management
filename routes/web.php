<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['middleware' => ['auth']], function () {
    Route::view('profile', 'profile')
        ->name('profile');

    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');
    Route::get('/products/create', \App\Livewire\CreateProduct::class)->name('products.create');
    Route::get('settings', \App\Livewire\Settings::class)->name('settings');
});
require __DIR__ . '/auth.php';
