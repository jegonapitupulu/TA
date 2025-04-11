<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JenisSimpananController;
use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\PinjamanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route to get all jenis_simpanan
Route::get('/jenis-simpanan', [JenisSimpananController::class, 'index']);

// Route to store a new jenis_simpanan
Route::post('/jenis-simpanan', [JenisSimpananController::class, 'store']);

// Route to get all anggota
Route::get('/anggota', [AnggotaController::class, 'index']);

// Route to store a new anggota
Route::post('/anggota', [AnggotaController::class, 'store']);

// Route to get all pinjaman
Route::get('/pinjaman', [PinjamanController::class, 'index']);


