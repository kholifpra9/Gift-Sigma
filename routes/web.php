<?php

use App\Http\Controllers\GiftOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gift-orders/create', [GiftOrderController::class, 'create'])->name('gift-orders.create');
    Route::post('/gift-orders', [GiftOrderController::class, 'store'])->name('gift-orders.store');
});

require __DIR__.'/auth.php';
