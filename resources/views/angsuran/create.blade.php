@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Tambah Angsuran</h1>

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
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
            <select name="pinjaman_id" id="pinjaman_id" class="form-control" required>
                <option value="">Pilih Pinjaman</option>
                @foreach($pinjaman as $p)
                    <option value="{{ $p->id }}">{{ $p->id }} - {{ $p->user->name }} ({{ $p->jumlah_pinjaman }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_angsuran" class="form-label">Jumlah Angsuran</label>
            <input type="number" class="form-control" id="jumlah_angsuran" name="jumlah_angsuran" value="{{ old('jumlah_angsuran') }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_angsuran" class="form-label">Tanggal Angsuran</label>
            <input type="date" class="form-control" id="tanggal_angsuran" name="tanggal_angsuran" value="{{ old('tanggal_angsuran') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection