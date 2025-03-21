<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjaman = Pinjaman::with(['user', 'admin'])->get(); // Load related user and admin data
        return view('pinjaman.index', compact('pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve only users with the role of 'anggota'
        $users = User::where('role', 'anggota')->get();
        return view('pinjaman.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_pinjaman' => 'required|in:uang,barang',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjaman' => 'required|numeric|min:1',
        ]);

        // Ensure the selected user is an 'anggota'
        $user = User::find($request->user_id);
        if (!$user || $user->role !== 'anggota') {
            return redirect()->route('pinjaman.create')
                             ->with('error', 'Only anggota can borrow.');
        }

        try {
            $pinjaman = new Pinjaman($request->all());
            $pinjaman->admin_id = auth()->user()->id; // Set admin_id from logged-in user
            $pinjaman->save();

            return redirect()->route('pinjaman.index')
                             ->with('success', 'Pinjaman created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('pinjaman.index')
                             ->with('error', 'Failed to create Pinjaman.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pinjaman $pinjaman)
    {
        return view('pinjaman.show', compact('pinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pinjaman $pinjaman)
    {
        // Retrieve only users with the role of 'anggota'
        $users = User::where('role', 'anggota')->get();
        return view('pinjaman.edit', compact('pinjaman', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_pinjaman' => 'required|in:uang,barang',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjaman' => 'required|numeric|min:1',
        ]);

        // Ensure the selected user is an 'anggota'
        $user = User::find($request->user_id);
        if (!$user || $user->role !== 'anggota') {
            return redirect()->route('pinjaman.edit', $pinjaman->id)
                             ->with('error', 'Only anggota can borrow.');
        }

        try {
            $pinjaman->update($request->all());
            $pinjaman->admin_id = auth()->user()->id; // Update admin_id from logged-in user
            $pinjaman->save();

            return redirect()->route('pinjaman.index')
                             ->with('success', 'Pinjaman updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('pinjaman.index')
                             ->with('error', 'Failed to update Pinjaman.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pinjaman $pinjaman)
    {
        try {
            $pinjaman->delete();

            return redirect()->route('pinjaman.index')
                             ->with('success', 'Pinjaman deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('pinjaman.index')
                             ->with('error', 'Failed to delete Pinjaman.');
        }
    }
}
