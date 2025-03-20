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
    public function index()
    {
        $simpanan = Simpanan::with(['user', 'jenisSimpanan', 'admin'])->get();
        return view('simpanan.index', compact('simpanan'));
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
    public function update(Request $request, Simpanan $simpanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_simpan_id' => 'required|exists:jenis_simpanans,id',
            'tanggal_simpan' => 'required|date',
        ]);

        try {
            $simpanan->update($request->all());
            $simpanan->admin_id = auth()->user()->id; // Update admin_id from logged-in user
            $simpanan->save();

            return redirect()->route('simpanan.index')
                             ->with('success', 'Simpanan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('simpanan.index')
                             ->with('error', 'Failed to update Simpanan.');
        }
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
