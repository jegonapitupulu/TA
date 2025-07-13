{{-- filepath: d:\MI6A\TA\resources\views\jenis_simpanan\create.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Jenis Simpanan</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⭐ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jenis_simpanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_jenis_simpanan" class="form-label">
                Nama Jenis Simpanan <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('nama_jenis_simpanan') is-invalid @enderror"
                   id="nama_jenis_simpanan" name="nama_jenis_simpanan"
                   value="{{ old('nama_jenis_simpanan') }}" required>
            @error('nama_jenis_simpanan')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">
                Nominal <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                   id="nominal" name="nominal"
                   value="{{ old('nominal') }}" required>
            @error('nominal')
                <div class="invalid-feedback">
                    ⭐ {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection