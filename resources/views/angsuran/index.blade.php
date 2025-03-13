@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Angsuran</h1>
    <a href="{{ route('angsuran.create') }}" class="btn btn-success mb-3">Tambah Angsuran</a>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Pinjaman ID</th>
                <th>Tanggal Angsuran</th>
                <th>Nominal Angsuran</th>
                <th>Angsuran Ke</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angsuran as $a)
            <tr>
                <td>{{ $a->user_id }}</td>
                <td>{{ $a->pinjaman_id }}</td>
                <td>{{ $a->tanggal_angsuran }}</td>
                <td>{{ $a->nominal_angsuran }}</td>
                <td>{{ $a->angsuran_ke }}</td>
                <td>{{ $a->admin_id }}</td>
                <td>
                    <a href="{{ route('angsuran.edit', $a->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('angsuran.destroy', $a->id) }}" method="POST" style="display:inline-block;">
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