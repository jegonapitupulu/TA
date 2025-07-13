@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Pinjaman</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⭐ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pinjaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam <span class="text-danger">*</span></label>
            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                <option value="">Pilih Peminjam</option>
                @foreach($users as $user)
                    @if($user->simpanan && $user->simpanan->count() > 0)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman <span class="text-danger">*</span></label>
            <select class="form-control @error('jenis_pinjaman') is-invalid @enderror" id="jenis_pinjaman" name="jenis_pinjaman" required>
                <option value="">Pilih Jenis</option>
                <option value="uang" {{ old('jenis_pinjaman') == 'uang' ? 'selected' : '' }}>Uang</option>
                <option value="barang" {{ old('jenis_pinjaman') == 'barang' ? 'selected' : '' }}>Barang</option>
            </select>
            @error('jenis_pinjaman')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" required>
            @error('tanggal_pinjam')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_pinjaman') is-invalid @enderror" id="jumlah_pinjaman" name="jumlah_pinjaman" value="{{ old('jumlah_pinjaman') }}" required>
            @error('jumlah_pinjaman')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection