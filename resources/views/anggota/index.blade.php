@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Anggota</h1>
    <a href="{{ route('anggota.create') }}" class="btn btn-success mb-3">Tambah Anggota</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Alamat</th>
                <th>HP</th>
                <th>TMT</th>
                <th>Status</th>
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
                <td>
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