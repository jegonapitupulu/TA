<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with application statistics.
     */
    public function index()
    {
        // Retrieve statistics
        $totalUsers = User::count();
        $totalSimpanan = DB::table('simpanans')
            ->join('jenis_simpanans', 'simpanans.jenis_simpan_id', '=', 'jenis_simpanans.id')
            ->sum('jenis_simpanans.nominal');
        $totalPinjaman = Pinjaman::sum('jumlah_pinjaman');
        $totalAdmins = User::where('role', 'admin')->count();
        $totalAnggota = User::where('role', 'anggota')->count();

        // Get total loans for each month in 2025
        $monthlyPinjaman = Pinjaman::selectRaw('MONTH(tanggal_pinjam) as month, SUM(jumlah_pinjaman) as total')
            ->whereYear('tanggal_pinjam', 2025)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Pass data to the view
        return view('dashboard', compact('totalUsers', 'totalSimpanan', 'totalPinjaman', 'totalAdmins', 'totalAnggota', 'monthlyPinjaman'));
    }
}