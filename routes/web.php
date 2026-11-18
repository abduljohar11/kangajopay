<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::get('status/pending', function () {
        return Inertia::render('status/Pending', [
            'pesan' => 'selamat datang pending',
        ]);
    })->name('status.pending');
    Route::get('status/suspended', function () {
        return Inertia::render('status/Suspended', [
            'pesan' => 'selamat datang Suspended',
        ]);
    })->name('status.suspended');
});

require __DIR__ . '/settings.php';
