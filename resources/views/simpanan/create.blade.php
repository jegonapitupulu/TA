@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Simpanan</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⭐ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('simpanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_simpan_id" class="form-label">Jenis Simpanan <span class="text-danger">*</span></label>
            <select class="form-control @error('jenis_simpan_id') is-invalid @enderror" id="jenis_simpan_id" name="jenis_simpan_id" required>
                <option value="">Pilih Jenis Simpanan</option>
                @foreach($jenisSimpanan as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('jenis_simpan_id') == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis_simpanan }}</option>
                @endforeach
            </select>
            @error('jenis_simpan_id')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal_simpan" class="form-label">Tanggal Simpan <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tanggal_simpan') is-invalid @enderror" id="tanggal_simpan" name="tanggal_simpan" value="{{ old('tanggal_simpan') }}" required>
            @error('tanggal_simpan')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection