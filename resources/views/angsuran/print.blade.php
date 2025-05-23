<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Bukti Setoran</title>
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
            text-align: center;
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

    <h1 class="header-title">Tanda Bukti Setoran</h1>
    <hr>

    <!-- Informasi Angsuran -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">Informasi Setoran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Nama Peminjam</strong></td>
                <td>{{ $angsuran->pinjaman->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Pinjaman</strong></td>
                <td>{{ ucfirst($angsuran->pinjaman->jenis_pinjaman) }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah Pinjaman</strong></td>
                <td>{{ number_format($angsuran->pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Setoran</strong></td>
                <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_angsuran)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Nominal Setoran</strong></td>
                <td>{{ number_format($angsuran->nominal_angsuran, 0, ',', '.') }}</td>
            </tr>
            @if($angsuran->angsuran_ke >= 1 && $angsuran->angsuran_ke <= 5)
            <tr>
                <td><strong>Bunga (5%)</strong></td>
                <td>
                    {{ number_format(($angsuran->pinjaman->jumlah_pinjaman / 10) * 0.05, 0, ',', '.') }}
                </td>
            </tr>
            @endif
            <tr>
                <td><strong>Sisa Pinjaman</strong></td>
                <td>{{ number_format($angsuran->pinjaman->jumlah_pinjaman - $angsuran->pinjaman->angsuran->sum('nominal_angsuran'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Angsuran Ke</strong></td>
                <td>{{ $angsuran->angsuran_ke }}</td>
            </tr>
            <tr>
                <td><strong>Diinput Oleh</strong></td>
                <td>{{ $angsuran->admin->name }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p><strong>Kepala Koperasi</strong></p>
        <br><br>
        <p><strong>Downny Ariansyah</strong></p>
    </div>

    <!-- Tombol Print -->
    <div class="no-print mt-3 text-center">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>