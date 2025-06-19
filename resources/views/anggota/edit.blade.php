{{-- filepath: d:\MI6A\TA\resources\views\anggota\edit.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Edit Anggota</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('anggota.create') }}" class="btn btn-success mb-3">Tambah Anggota</a>
    @endif

    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $anggota->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $anggota->alamat) }}">
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">Nomor HP</label>
                    <input type="number" min="0" class="form-control" id="hp" name="hp" value="{{ old('hp', $anggota->hp) }}">
                </div>
                <div class="mb-3">
                    <label for="gmail" class="form-label">email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $anggota->email) }}">
                </div>
                <div class="mb-3">
                    <label for="tmt" class="form-label">TMT</label>
                    <input type="date" class="form-control" id="tmt" name="tmt" value="{{ old('tmt', $anggota->tmt) }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="aktif" {{ old('status', $anggota->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status', $anggota->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" {{ old('role', $anggota->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="anggota" {{ old('role', $anggota->role) == 'anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="badge" class="form-label">Badge</label>
                    <input type="number" min="0" class="form-control" id="badge" name="badge" value="{{ old('badge', $anggota->badge) }}">
                </div>
                <div class="mb-3">
                    <label for="no_anggota" class="form-label">Nomor Anggota</label>
                    <input type="number" min="0" class="form-control" id="no_anggota" name="no_anggota" value="{{ old('no_anggota', $anggota->no_anggota) }}">
                </div>
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">Nomor Rekening</label>
                    <input type="number" min="0" class="form-control" id="no_rekening" name="no_rekening" value="{{ old('no_rekening', $anggota->no_rekening) }}">
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank</label>
                    <input type="text" class="form-control" id="bank" name="bank" value="{{ old('bank', $anggota->bank) }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection