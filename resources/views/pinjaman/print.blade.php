<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pinjaman</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header-title {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .table {
            width: 100% !important;
        }
        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd !important;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="header-title">Detail Pinjaman</h1>
    <hr>

    <!-- Informasi Pinjaman -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">Informasi Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>ID Pinjaman</strong></td>
                <td>{{ $pinjaman->id }}</td>
            </tr>
            <tr>
                <td><strong>Nama Peminjam</strong></td>
                <td>{{ $pinjaman->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Badge</strong></td>
                <td>{{ $pinjaman->user->badge }}</td>
            </tr>
            <tr>
                <td><strong>Nomor Anggota</strong></td>
                <td>{{ $pinjaman->user->no_anggota }}</td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>{{ $pinjaman->user->alamat }}</td>
            </tr>
            <tr>
                <td><strong>Nomor HP</strong></td>
                <td>{{ $pinjaman->user->hp }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Pinjaman</strong></td>
                <td>{{ ucfirst($pinjaman->jenis_pinjaman) }}</td>
            </tr>
            @if($pinjaman->jenis_pinjaman === 'barang')
            <tr>
                <td><strong>Nama Bank</strong></td>
                <td>{{ $pinjaman->user->bank }}</td>
            </tr>
            <tr>
                <td><strong>Nomor Rekening</strong></td>
                <td>{{ $pinjaman->user->no_rekening }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Jumlah Pinjaman</strong></td>
                <td>{{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pinjam</strong></td>
                <td>{{ $pinjaman->tanggal_pinjam }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>{{ ucfirst($pinjaman->status_pinjaman) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Daftar Angsuran -->
    <h4 class="mt-4">Daftar Angsuran</h4>
    <table class="table table-bordered">
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

    <!-- Print Button -->
    <div class="no-print mt-3 text-center">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>