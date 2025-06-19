@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Simpanan</h1>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('simpanan.create') }}" class="btn btn-success mb-3">Tambah Simpanan</a>
    @endif
    <form action="{{ route('simpanan.update', $simpanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $simpanan->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_simpanan_id" class="form-label">Jenis Simpanan</label>
            <select class="form-control" id="jenis_simpanan_id" name="jenis_simpanan_id" required>
                @foreach($jenisSimpanan as $jenis)
                    <option value="{{ $jenis->id }}" {{ $simpanan->jenis_simpanan_id == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama_jenis_simpanan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_simpan" class="form-label">Tanggal Simpan</label>
            <input type="date" class="form-control" id="tanggal_simpan" name="tanggal_simpan" value="{{ $simpanan->tanggal_simpan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection