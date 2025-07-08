{{-- filepath: d:\MI6A\TA\resources\views\pinjaman\edit.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Pinjaman</h1>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $pinjaman->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
            <select class="form-control" id="jenis_pinjaman" name="jenis_pinjaman" required>
                <option value="uang" {{ $pinjaman->jenis_pinjaman == 'uang' ? 'selected' : '' }}>Uang</option>
                <option value="barang" {{ $pinjaman->jenis_pinjaman == 'barang' ? 'selected' : '' }}>Barang</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
            <input type="number" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" value="{{ old('jumlah_pinjaman', $pinjaman->jumlah_pinjaman) }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $pinjaman->tanggal_pinjam) }}" required>
        </div>
        <div class="mb-3">
            <label for="status_pinjaman" class="form-label">Status Pinjaman</label>
            <select class="form-control" id="status_pinjaman" name="status_pinjaman" required>
                <option value="belum lunas" {{ $pinjaman->status_pinjaman == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="lunas" {{ $pinjaman->status_pinjaman == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection