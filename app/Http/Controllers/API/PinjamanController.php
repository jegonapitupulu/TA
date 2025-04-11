<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Get all Pinjaman data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Retrieve all Pinjaman records with related user and admin data
            $pinjaman = Pinjaman::with(['user', 'admin'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Pinjaman retrieved successfully.',
                'data' => $pinjaman,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Pinjaman.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
