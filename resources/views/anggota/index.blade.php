@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Anggota</h1>

    <!-- Search Form -->
    <form action="{{ route('anggota.index') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Search by Name -->
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Cari Nama" value="{{ request('name') }}">
            </div>

            <!-- Search by Alamat -->
            <div class="col-md-4">
                <input type="text" name="alamat" class="form-control" placeholder="Cari Alamat" value="{{ request('alamat') }}">
            </div>

            <!-- Search by Role -->
            <div class="col-md-3">
                <select name="role" class="form-control">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="anggota" {{ request('role') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <a href="{{ route('anggota.create') }}" class="btn btn-success mb-3">Tambah Anggota</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Alamat</th>
                <th>HP</th>
                <th>TMT</th>
                <th>Status</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggota as $a)
            <tr>
                <td>{{ $a->name }}</td>
                <td>{{ $a->alamat }}</td>
                <td>{{ $a->hp }}</td>
                <td>{{ $a->tmt }}</td>
                <td>{{ $a->status }}</td>
                <td>{{ ucfirst($a->role) }}</td>
                <td>
                    <a href="{{ route('anggota.show', $a->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection