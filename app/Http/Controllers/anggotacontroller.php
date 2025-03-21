<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class anggotacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = User::where('role', 'anggota')->get();
        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:anggota',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'tmt' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'tmt' => $request->tmt,
            'status' => $request->status,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = User::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = User::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:anggota',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'tmt' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $anggota = User::findOrFail($id);
        $anggota->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $anggota->password,
            'role' => $request->role,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'tmt' => $request->tmt,
            'status' => $request->status,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = User::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota deleted successfully.');
    }
}
