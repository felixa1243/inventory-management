<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');


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
});
require __DIR__ . '/auth.php';
