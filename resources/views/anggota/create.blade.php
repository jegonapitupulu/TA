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
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="hp" name="hp" value="{{ old('hp') }}" required>
        </div>
        <div class="mb-3">
            <label for="tmt" class="form-label">Tanggal Mulai Tugas (TMT)</label>
            <input type="date" class="form-control" id="tmt" name="tmt" value="{{ old('tmt') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Active</option>
                <option value="tidak" {{ old('status') == 'tidak' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <input type="hidden" name="role" value="anggota">
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection