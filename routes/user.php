<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('user/Dashboard', [
        'pesan' => 'selamaat datang user',
    ]);
})->name('dashboard');
