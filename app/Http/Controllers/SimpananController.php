<?php

namespace App\Http\Controllers;

use App\Models\jenis_simpanan;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Simpanan::with(['user', 'jenisSimpanan', 'admin']); // Start query with related user, jenisSimpanan, and admin data

        // Jika user adalah anggota, hanya tampilkan simpanan miliknya sendiri
        if (auth()->user()->role === 'anggota') {
            $query->where('user_id', auth()->id());
        } else {
            // Filter by user name (anggota)
            if ($request->has('user') && $request->user) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->user . '%');
                });
            }

            // Filter by jenis simpanan
            if ($request->has('jenis_simpan_id') && $request->jenis_simpan_id) {
                $query->where('jenis_simpan_id', $request->jenis_simpan_id);
            }

            // Filter by tanggal simpanan
            if ($request->has('tanggal_simpan') && $request->tanggal_simpan) {
                $query->whereDate('tanggal_simpan', $request->tanggal_simpan);
            }
        }

        // Execute the query and get the results
        $simpanan = $query->orderBy('tanggal_simpan', 'desc')->get(); // Urutkan berdasarkan tanggal simpanan terbaru
        $jenisSimpanan = jenis_simpanan::all(); // Fetch all jenis simpanan for the dropdown

        return view('simpanan.index', compact('simpanan', 'jenisSimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'anggota')->get();
        $jenisSimpanan = jenis_simpanan::all();
        return view('simpanan.create', compact('users', 'jenisSimpanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_simpan_id' => 'required|exists:jenis_simpanans,id',
            'tanggal_simpan' => 'required|date',
        ]);

        try {
            $simpanan = new Simpanan($request->all());
            $simpanan->admin_id = auth()->user()->id; // Set admin_id from logged-in user
            $simpanan->save();

            return redirect()->route('simpanan.index')
                             ->with('success', 'Simpanan created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('simpanan.index')
                             ->with('error', 'Failed to create Simpanan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Simpanan $simpanan)
    {
        return view('simpanan.show', compact('simpanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Simpanan $simpanan)
    {
        $users = User::where('role', 'anggota')->get();
        $jenisSimpanan = jenis_simpanan::all();
        return view('simpanan.edit', compact('simpanan', 'users', 'jenisSimpanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_simpan_id' => 'required|exists:jenis_simpanans,id',
            'tanggal_simpan' => 'required|date',
        ]);

            $simpanan = Simpanan::findOrFail($id);
            $simpanan->user_id = $request->user_id;
            $simpanan->jenis_simpan_id = $request->jenis_simpan_id;
            $simpanan->tanggal_simpan = $request->tanggal_simpan;
            // tambahkan field lain jika ada
            $simpanan->save();

            return redirect()->route('simpanan.index')
                             ->with('success', 'Simpanan updated successfully.');
                             
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simpanan $simpanan)
    {
        try {
            $simpanan->delete();

            return redirect()->route('simpanan.index')
                             ->with('success', 'Simpanan deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('simpanan.index')
                             ->with('error', 'Failed to delete Simpanan.');
        }
    }
}
