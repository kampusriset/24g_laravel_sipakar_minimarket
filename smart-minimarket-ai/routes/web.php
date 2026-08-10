<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HistoryRestockController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{sale}', [HistoryController::class, 'show'])->name('history.show');
    Route::get('/history/{sale}/pdf', [HistoryController::class, 'pdf'])->name('history.pdf');
    Route::get('/kasir/history', [KasirController::class, 'history'])->name('kasir.history');
    Route::get('/kasir/history/{sale}', [KasirController::class, 'detail'])->name('kasir.detail');
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/checkout', [KasirController::class, 'checkout'])->name('kasir.checkout');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard-report', [DashboardController::class, 'index'])->name('dashboard.report');
    Route::get('/restock', [RestockController::class, 'index'])->name('restock.index');
     Route::get('/riwayat-restock',
        [HistoryRestockController::class,'index']
    )
    ->name('history.restock');

    Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');

    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
    ->name('laporan.pdf');

    Route::get('/laporan/excel', [LaporanController::class, 'excel'])
    ->name('laporan.excel');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');
    
require __DIR__ . '/auth.php';
