<?php

use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\JenissimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\AnggotaController; // Add this line
use App\Http\Controllers\DashboardController; // Add this line
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('jenis_simpanan', JenisSimpananController::class);
Route::resource('pinjaman', PinjamanController::class);
Route::resource('angsuran', AngsuranController::class);
Route::resource('simpanan', SimpananController::class);
Route::resource('anggota', AnggotaController::class); // Add this line

require __DIR__.'/auth.php';
