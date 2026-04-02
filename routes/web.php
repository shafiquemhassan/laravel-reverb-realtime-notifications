<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/index', [ProductController::class, 'index'])->name('products.index');
    Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');
    Route::get('/notifications', [ProductController::class, 'notifications'])->name('notifications.index');
    Route::get('/mark-read', [ProductController::class, 'markRead'])->name('notifications.markRead');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
