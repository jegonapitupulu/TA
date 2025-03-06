<?php

namespace App\Http\Controllers;

use App\Models\jenis_pimpanan;
use Illuminate\Http\Request;

class JenisPimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_pimpanan = jenis_pimpanan::all();
        return view('jenis_pimpanan.index', compact('jenis_pimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis_pimpanan $jenis_pimpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis_pimpanan $jenis_pimpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenis_pimpanan $jenis_pimpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_pimpanan $jenis_pimpanan)
    {
        //
    }
}
