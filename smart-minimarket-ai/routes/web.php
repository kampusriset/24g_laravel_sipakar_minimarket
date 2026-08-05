<?php

use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/kasir/history', [KasirController::class, 'history'])->name('kasir.history');
    Route::get('/kasir/history/{sale}', [KasirController::class, 'detail'])->name('kasir.detail');
});

Route::get('/restock-ai', [RestockController::class, 'index'])
    ->name('restock.ai');

Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');
    Route::get('/history/{sale}', [HistoryController::class, 'show'])
        ->name('history.show');
    Route::get('/history/{sale}/pdf', [HistoryController::class, 'pdf'])
        ->name('history.pdf');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/checkout', [KasirController::class, 'checkout'])->name('kasir.checkout');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard-report',
        [DashboardController::class,'index'])
        ->name('dashboard.report');

});

require __DIR__ . '/auth.php';
