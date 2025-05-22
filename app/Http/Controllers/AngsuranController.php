<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angsuran = Angsuran::with('pinjaman')->get(); // Include related Pinjaman data
        return view('angsuran.index', compact('angsuran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch only Pinjaman with status_pinjaman = 'belum'
        $pinjaman = Pinjaman::where('status_pinjaman', 'belum')->get();

        return view('angsuran.create', compact('pinjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamen,id',
            'nominal_angsuran' => 'required|numeric|min:1',
            'tanggal_angsuran' => 'required|date',
        ]);

        try {
            // Hitung angsuran_ke berdasarkan jumlah angsuran sebelumnya
            $angsuranKe = Angsuran::where('pinjaman_id', $request->pinjaman_id)->count() + 1;

            // Tambahkan admin_id berdasarkan pengguna yang sedang login
            $adminId = auth()->id();

            // Buat data angsuran baru
            Angsuran::create([
                'pinjaman_id' => $request->pinjaman_id,
                'nominal_angsuran' => $request->nominal_angsuran,
                'tanggal_angsuran' => $request->tanggal_angsuran,
                'angsuran_ke' => $angsuranKe,
                'admin_id' => $adminId,
            ]);

            return redirect()->route('angsuran.index')
                             ->with('success', 'Angsuran created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('angsuran.index')
                             ->with('error', 'Failed to create Angsuran.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Angsuran $angsuran)
    {
        return view('angsuran.show', compact('angsuran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Angsuran $angsuran)
    {
        $pinjaman = Pinjaman::all(); // Fetch all Pinjaman for the dropdown
        return view('angsuran.edit', compact('angsuran', 'pinjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Angsuran $angsuran)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamans,id',
            'jumlah_angsuran' => 'required|numeric|min:1',
            'tanggal_angsuran' => 'required|date',
        ]);

        try {
            $angsuran->update($request->all());

            return redirect()->route('angsuran.index')
                             ->with('success', 'Angsuran updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('angsuran.index')
                             ->with('error', 'Failed to update Angsuran.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Angsuran $angsuran)
    {
        try {
            $angsuran->delete();

            return redirect()->route('angsuran.index')
                             ->with('success', 'Angsuran deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('angsuran.index')
                             ->with('error', 'Failed to delete Angsuran.');
        }
    }
}
