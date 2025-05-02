@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Detail Pinjaman</h1>

    <!-- Pinjaman Details -->
    <div class="card mb-4">
        <div class="card-header">
            Informasi Pinjaman
        </div>
        <div class="card-body">
            <p><strong>ID Pinjaman:</strong> {{ $pinjaman->id }}</p>
            <p><strong>Nama Peminjam:</strong> {{ $pinjaman->user->name }}</p>
            <p><strong>Jumlah Pinjaman:</strong> {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $pinjaman->tanggal_pinjam }}</p>
            <p><strong>Status Pinjaman:</strong> {{ ucfirst($pinjaman->status_pinjaman) }}</p>
        </div>
    </div>

    <!-- Daftar Angsuran -->
    <h2>Daftar Angsuran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Angsuran</th>
                <th>Jumlah Angsuran</th>
                <th>Tanggal Angsuran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjaman->angsuran as $angsuran)
            <tr>
                <td>{{ $angsuran->id }}</td>
                <td>{{ number_format($angsuran->nominal_angsuran, 0, ',', '.') }}</td>
                <td>{{ $angsuran->tanggal_angsuran }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada angsuran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection