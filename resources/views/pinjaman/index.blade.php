@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Pinjaman</h1>
    <a href="{{ route('pinjaman.create') }}" class="btn btn-success mb-3">Tambah Pinjaman</a>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Jenis Pinjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinjaman as $p)
            <tr>
                <td>{{ $p->user_id }}</td>
                <td>{{ $p->jenis_pinjaman }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->admin_id }}</td>
                <td>
                    <a href="{{ route('pinjaman.edit', $p->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('pinjaman.destroy', $p->id) }}" method="POST" style="display:inline-block;">
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