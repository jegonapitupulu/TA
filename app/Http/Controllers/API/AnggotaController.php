<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JenisSimpananController;
use App\Http\Controllers\API\PinjamanController;

class AnggotaController extends Controller
{
    /**
     * Get all Anggota data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Retrieve all users with the role 'anggota'
            $anggota = User::where('role', 'anggota')->get();

            return response()->json([
                'success' => true,
                'message' => 'Anggota retrieved successfully.',
                'data' => $anggota,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Anggota.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new Anggota.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|string',
            ]);

            $anggota = User::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Anggota created successfully.',
                'data' => $anggota,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Anggota.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

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
