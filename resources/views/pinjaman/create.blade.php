@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Pinjaman</h1>
    <form action="{{ route('pinjaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
            <select class="form-control" id="jenis_pinjaman" name="jenis_pinjaman" required>
                <option value="uang">Uang</option>
                <option value="barang">Barang</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
            <input type="number" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection