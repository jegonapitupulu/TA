@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Simpanan</h1>
    <form action="{{ route('simpanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_simpan_id" class="form-label">Jenis Simpanan</label>
            <select class="form-control" id="jenis_simpan_id" name="jenis_simpan_id" required>
                @foreach($jenisSimpanan as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_simpanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_simpan" class="form-label">Tanggal Simpan</label>
            <input type="date" class="form-control" id="tanggal_simpan" name="tanggal_simpan" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection