<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('qr-codes.index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/qr-codes', [QrCodeController::class, 'index'])->name('qr-codes.index');
    Route::post('/qr-codes', [QrCodeController::class, 'store'])->name('qr-codes.store');
    Route::get('/qr-codes/{id}', [QrCodeController::class, 'show'])->name('qr-codes.show');
    Route::delete('/qr-codes/{id}', [QrCodeController::class, 'destroy'])->name('qr-codes.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return redirect()->route('qr-codes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de autenticación
require __DIR__.'/auth.php';

