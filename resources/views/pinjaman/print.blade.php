<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Bukti Pinjaman</title>
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
        .kop-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-header h2, .kop-header h4 {
            margin: 0;
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
        .footer {
            margin-top: 50px;
        }
        .signature-space {
            margin-top: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Kop Header -->
    <div class="kop-header">
        <h2>KOPKAR RUSARI</h2>
        <h4>Koperasi Karyawan Rumah Sakit Pusri</h4>
        <p>Alamat: Jl. Flamboyan No.1 Telpon: 0711-712222 ext. 3712</p>
        <hr>
    </div>

    <h1 class="header-title">Tanda Bukti Pinjaman</h1>
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
                <td><strong>Jumlah Pinjaman</strong></td>
                <td>{{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pinjam</strong></td>
                <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
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
                <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_angsuran)->translatedFormat('d F Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada angsuran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer mt-5">
        <div class="text-center mb-4">
            <p>Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
        <table class="table table-bordered">
            <tr>
                <td class="text-center">
                    <p><strong>Mengetahui</strong></p>
                    <div class="signature-space">..............</div>
                    <p>{{ auth()->user()->name }}</p> <!-- Nama Admin -->
                </td>
                <td class="text-center">
                    <p><strong>Pemohon</strong></p>
                    <div class="signature-space">..............</div>
                    <p>{{ $pinjaman->user->name }}</p> <!-- Nama Nasabah -->
                </td>
            </tr>
        </table>
        <div class="text-center mt-4">
            <p><strong>Disetujui Oleh</strong></p>
            <div class="signature-space">..............</div>
            <p>1. Ketua</p>
            <div class="signature-space">..............</div>
            <p>2. Sekretaris</p>
            <div class="signature-space">..............</div>
            <p>3. Bendahara</p>
        </div>
    </div>

    <!-- Print Button -->
    <div class="no-print mt-3 text-center">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>