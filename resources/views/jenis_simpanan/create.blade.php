@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Jenis Simpanan</h1>
    <form action="{{ route('jenis_simpanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_jenis_simpanan" class="form-label">Nama Jenis Simpanan</label>
            <input type="text" class="form-control" id="nama_jenis_simpanan" name="nama_jenis_simpanan" required>
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection