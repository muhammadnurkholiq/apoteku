<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// dashboard
Route::get('/dashboard', [ProductController::class, 'buyerIndex'])->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // cart
    Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // transactions
    Route::post('/transactions', [TransactionsController::class, 'store'])->name('transactions.store');

    // admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        Route::resource('transactions', TransactionsController::class)->middleware('role:owner');
    });
});

require __DIR__ . '/auth.php';
