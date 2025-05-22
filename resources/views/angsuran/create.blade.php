@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Tambah Angsuran</h1>

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <h4>Terjadi Kesalahan:</h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('angsuran.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="pinjaman_id" class="form-label">Pinjaman</label>
            <select name="pinjaman_id" id="pinjaman_id" class="form-control @error('pinjaman_id') is-invalid @enderror" required>
                <option value="">Pilih Pinjaman</option>
                @foreach($pinjaman as $p)
                    <option value="{{ $p->id }}" {{ old('pinjaman_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->id }} - {{ $p->user->name }} ({{ $p->jumlah_pinjaman }})
                    </option>
                @endforeach
            </select>
            @error('pinjaman_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nominal_angsuran" class="form-label">Nominal Angsuran</label>
            <input type="number" class="form-control @error('nominal_angsuran') is-invalid @enderror" id="nominal_angsuran" name="nominal_angsuran" value="{{ old('nominal_angsuran') }}" required>
            @error('nominal_angsuran')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal_angsuran" class="form-label">Tanggal Angsuran</label>
            <input type="date" class="form-control @error('tanggal_angsuran') is-invalid @enderror" id="tanggal_angsuran" name="tanggal_angsuran" value="{{ old('tanggal_angsuran') }}" required>
            @error('tanggal_angsuran')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection