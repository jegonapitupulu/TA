@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Angsuran</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('angsuran.create') }}" class="btn btn-success mb-3">Tambah Angsuran</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Tanggal Angsuran</th>
                <th>Nominal Angsuran</th>
                <th>Sisa Pinjaman</th>
                <th>Angsuran Ke</th>
                <th>Sisa Angsuran</th> <!-- Tambahan kolom -->
                <th>Di Input Oleh</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angsuran as $a)
            <tr>
                <td>{{ $a->pinjaman->user->name }}</td>
                <td>{{ $a->pinjaman->jenis_pinjaman }}</td>
                <td>{{ number_format($a->pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                <td>{{ $a->tanggal_angsuran }}</td>
                <td>{{ number_format($a->nominal_angsuran, 0, ',', '.') }}</td>
                <td>{{ number_format($a->pinjaman->jumlah_pinjaman - $a->pinjaman->angsuran->sum('nominal_angsuran'), 0, ',', '.') }}</td>
                <td>{{ $a->angsuran_ke }}</td>
                <td>
                    {{ 10 - $a->angsuran_ke }}
                </td> <!-- Sisa Angsuran -->
                <td>{{ $a->admin->name }}</td>
                <td>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('angsuran.edit', $a->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('angsuran.destroy', $a->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                    <a href="{{ route('angsuran.print', $a->id) }}" class="btn btn-secondary">Cetak</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection