<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
}

