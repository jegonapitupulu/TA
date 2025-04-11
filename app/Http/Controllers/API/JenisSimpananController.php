<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jenis_simpanan;
use Illuminate\Http\Request;

class JenisSimpananController extends Controller
{
    /**
     * Get all Jenis Simpanan data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $jenisSimpanan = jenis_simpanan::all(); // Retrieve all records from the jenis_simpanans table
            return response()->json([
                'success' => true,
                'message' => 'Jenis Simpanan retrieved successfully.',
                'data' => $jenisSimpanan,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Jenis Simpanan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created Jenis Simpanan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_simpanan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        try {
            $jenisSimpanan = jenis_simpanan::create([
                'nama_jenis_simpanan' => $request->nama_jenis_simpanan,
                'nominal' => $request->nominal,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jenis Simpanan created successfully.',
                'data' => $jenisSimpanan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Jenis Simpanan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
