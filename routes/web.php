<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GiftCatalogController;
use App\Http\Controllers\GiftOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gift-orders/create', [GiftOrderController::class, 'create'])->name('gift-orders.create');
    Route::post('/gift-orders', [GiftOrderController::class, 'store'])->name('gift-orders.store');

    Route::get('/gift-orders', [GiftOrderController::class, 'index'])->name('gift-orders.index');

    Route::get('/gift-orders/{id}', [GiftOrderController::class, 'show'])->name('gift-orders.show');
    Route::resource('gift-catalogs', GiftCatalogController::class);
    Route::post('/gift-catalogs', [GiftCatalogController::class, 'store'])->name('gift-catalogs.store');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

});

require __DIR__.'/auth.php';
