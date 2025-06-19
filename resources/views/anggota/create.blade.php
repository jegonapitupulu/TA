@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Anggota</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>
                <div class="mb-3" id="password-section">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3" id="password-confirmation-section">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">Nomor HP</label>
                    <input type="number" min="0" class="form-control" id="hp" name="hp" value="{{ old('hp') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tmt" class="form-label">Tanggal Mulai Tugas (TMT)</label>
                    <input type="date" class="form-control" id="tmt" name="tmt" value="{{ old('tmt') }}" required>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Active</option>
                        <option value="tidak" {{ old('status') == 'tidak' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="badge" class="form-label">Badge</label>
                    <input type="number" min="0" class="form-control" id="badge" name="badge" value="{{ old('badge') }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_anggota" class="form-label">Nomor Anggota</label>
                    <input type="number" min="0" class="form-control" id="no_anggota" name="no_anggota" value="{{ old('no_anggota') }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">Nomor Rekening</label>
                    <input type="number" min="0" class="form-control" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}" required>
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank</label>
                    <input type="text" class="form-control" id="bank" name="bank" value="{{ old('bank') }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>


@endsection