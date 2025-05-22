<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    /**
     * Get all Angsuran data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Retrieve all records from the angsurans table
            $angsurans = Angsuran::with('pinjaman')->get(); // Include related Pinjaman data

            return response()->json([
                'success' => true,
                'message' => 'Angsuran retrieved successfully.',
                'data' => $angsurans,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Angsuran.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new Angsuran.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamen,id',
            'nominal_angsuran' => 'required|numeric|min:1',
            'tanggal_angsuran' => 'required|date',
        ]);

        try {
            $angsuran = Angsuran::create([
                'pinjaman_id' => $request->pinjaman_id,
                'nominal_angsuran' => $request->nominal_angsuran,
                'tanggal_angsuran' => $request->tanggal_angsuran,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Angsuran created successfully.',
                'data' => $angsuran,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Angsuran.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

