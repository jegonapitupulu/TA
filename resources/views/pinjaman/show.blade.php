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
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <p><strong>ID Pinjaman:</strong> {{ $pinjaman->id }}</p>
                    <p><strong>Nama Peminjam:</strong> {{ $pinjaman->user->name }}</p>
                    <p><strong>Badge:</strong> {{ $pinjaman->user->badge }}</p>
                    <p><strong>Nomor Anggota:</strong> {{ $pinjaman->user->no_anggota }}</p>
                    <p><strong>Alamat Peminjam:</strong> {{ $pinjaman->user->alamat }}</p>
                </div>
                <!-- Right Column -->
                <div class="col-md-6">
                    <p><strong>Nomor HP Peminjam:</strong> {{ $pinjaman->user->hp }}</p>
                    <p><strong>Jenis Pinjaman:</strong> {{ ucfirst($pinjaman->jenis_pinjaman) }}</p>
                    @if($pinjaman->jenis_pinjaman === 'barang')
                        <p><strong>Nama Bank:</strong> {{ $pinjaman->user->bank }}</p>
                        <p><strong>Nomor Rekening:</strong> {{ $pinjaman->user->no_rekening }}</p>
                    @endif
                    <p><strong>Jumlah Pinjaman:</strong> {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</p>
                    <p><strong>Tanggal Pinjam:</strong> {{ $pinjaman->tanggal_pinjam }}</p>
                    <p><strong>Status Pinjaman:</strong> {{ ucfirst($pinjaman->status_pinjaman) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Angsuran -->
    <h2>Daftar Angsuran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>angsuran_ke</th>
                <th>Jumlah Angsuran</th>
                <th>Tanggal Angsuran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjaman->angsuran as $angsuran)
            <tr>
                <td>{{ $angsuran->angsuran_ke }}</td>
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

    <!-- Print Button -->
    <a href="{{ route('pinjaman.print', $pinjaman->id) }}" class="btn btn-primary">Print</a>
    <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection