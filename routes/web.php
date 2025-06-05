<?php

use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\JenissimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   // return view('welcome');//
   return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('jenis_simpanan', JenisSimpananController::class);
Route::resource('pinjaman', PinjamanController::class);
Route::get('/pinjaman/{pinjaman}/print', [PinjamanController::class, 'print'])->name('pinjaman.print');
Route::resource('angsuran', AngsuranController::class);
Route::get('/angsuran/{angsuran}/print', [AngsuranController::class, 'print'])->name('angsuran.print'); // Route Print Angsuran
Route::resource('simpanan', SimpananController::class);
Route::resource('anggota', AnggotaController::class);

require __DIR__.'/auth.php';
