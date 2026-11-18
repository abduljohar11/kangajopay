<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('admin/Dashboard', [
        'pesan' => 'selamaat datang admin',
    ]);
})->name('dashboard');

// Route::prefix('categories')
//     ->name('categories.')
//     ->controller(CategoryController::class)
//     ->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::post('/store', 'store')->name('store');
//         Route::patch('/{category}', 'update')->name('update');
//     });
