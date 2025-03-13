@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Simpanan</h1>
    <a href="{{ route('simpanan.create') }}" class="btn btn-success mb-3">Tambah Simpanan</a>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Jenis Simpanan</th>
                <th>Tanggal Simpan</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($simpanan as $s)
            <tr>
                <td>{{ $s->user_id }}</td>
                <td>{{ $s->jenis_simpan_id }}</td>
                <td>{{ $s->tanggal_simpan }}</td>
                <td>{{ $s->admin_id }}</td>
                <td>
                    <a href="{{ route('simpanan.edit', $s->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('simpanan.destroy', $s->id) }}" method="POST" style="display:inline-block;">
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