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
                    <li>⭐ {{ $error }}</li>
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
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="anggota" {{ old('role') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3" id="password-section">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3" id="password-confirmation-section">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" value="{{ old('hp') }}" required>
                    @error('hp')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tmt" class="form-label">Tanggal Mulai Tugas (TMT) <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tmt') is-invalid @enderror" id="tmt" name="tmt" value="{{ old('tmt') }}" required>
                    @error('tmt')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Active</option>
                        <option value="tidak" {{ old('status') == 'tidak' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="badge" class="form-label">Badge <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control @error('badge') is-invalid @enderror" id="badge" name="badge" value="{{ old('badge') }}" required>
                    @error('badge')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_anggota" class="form-label">Nomor Anggota <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control @error('no_anggota') is-invalid @enderror" id="no_anggota" name="no_anggota" value="{{ old('no_anggota') }}" required>
                    @error('no_anggota')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}" required>
                    @error('no_rekening')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" value="{{ old('bank') }}" required>
                    @error('bank')
                        <div class="invalid-feedback">
                            ⭐ {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>


@endsection