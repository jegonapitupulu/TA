<?php

namespace App\Http\Controllers;

use App\Models\jenis_simpanan;
use Illuminate\Http\Request;

class JenissimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_simpanan = jenis_simpanan::all();
        return view('jenis_simpanan.index', compact('jenis_simpanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_simpanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_simpanan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        jenis_simpanan::create($request->all());

        return redirect()->route('jenis_simpanan.index')
                         ->with('success', 'Jenis Simpanan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis_simpanan $jenis_simpanan)
    {
        return view('jenis_simpanan.show', compact('jenis_simpanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis_simpanan $jenis_simpanan)
    {
        return view('jenis_simpanan.edit', compact('jenis_simpanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenis_simpanan $jenis_simpanan)
    {
        $request->validate([
            'nama_jenis_simpanan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $jenis_simpanan->update($request->all());

        return redirect()->route('jenis_simpanan.index')
                         ->with('success', 'Jenis Simpanan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_simpanan $jenis_simpanan)
    {
        $jenis_simpanan->delete();

        return redirect()->route('jenis_simpanan.index')
                         ->with('success', 'Jenis Simpanan deleted successfully.');
    }
}
