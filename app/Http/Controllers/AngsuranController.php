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

        // Hitung angsuran_ke berdasarkan jumlah angsuran sebelumnya
        $angsuranKe = Angsuran::where('pinjaman_id', $request->pinjaman_id)->count() + 1;

        // Tambahkan admin_id berdasarkan pengguna yang sedang login
        $adminId = auth()->id();

        // Tambahkan bunga 5% untuk angsuran ke-1 hingga ke-5
        $nominalAngsuran = $request->nominal_angsuran;
        if ($angsuranKe >= 1 && $angsuranKe <= 5) {
            $nominalAngsuran += $nominalAngsuran * 0.05; // Tambahkan bunga 5%
        }

        // Buat data angsuran baru
        Angsuran::create([
            'pinjaman_id' => $request->pinjaman_id,
            'nominal_angsuran' => $nominalAngsuran,
            'tanggal_angsuran' => $request->tanggal_angsuran,
            'angsuran_ke' => $angsuranKe,
            'admin_id' => $adminId,
        ]);

        return redirect()->route('angsuran.index')
                         ->with('success', 'Angsuran created successfully.');
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

        $angsuran->update($request->all());

        return redirect()->route('angsuran.index')
                         ->with('success', 'Angsuran updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Angsuran $angsuran)
    {
        // Cek status pinjaman, hanya bisa dihapus jika status 'lunas'
        if ($angsuran->pinjaman->status_pinjaman !== 'lunas') {
            return redirect()->route('angsuran.index')
                             ->with('error', 'Angsuran tidak bisa dihapus karena status pinjaman belum lunas.');
        }

        $angsuran->delete();

        return redirect()->route('angsuran.index')
                         ->with('success', 'Angsuran deleted successfully.');
    }

    /**
     * Print the specified resource.
     */
    public function print($id)
    {
        $angsuran = Angsuran::with('pinjaman.user', 'admin')->findOrFail($id); // Load related data
        return view('angsuran.print', compact('angsuran'));
    }
}
