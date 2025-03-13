@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Jenis Simpanan</h1>
    <form action="{{ route('jenis_simpanan.update', $jenis_simpanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_jenis_simpanan" class="form-label">Nama Jenis Simpanan</label>
            <input type="text" class="form-control" id="nama_jenis_simpanan" name="nama_jenis_simpanan" value="{{ $jenis_simpanan->nama_jenis_simpanan }}" required>
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $jenis_simpanan->nominal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection