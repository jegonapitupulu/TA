@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Pinjaman</h1>

    <!-- Search Form -->
    <form action="{{ route('pinjaman.index') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Search by User -->
            <div class="col-md-3">
                <input type="text" name="user" class="form-control" placeholder="Cari Nama Peminjam" value="{{ request('user') }}">
            </div>

            <!-- Search by Jenis Pinjaman -->
            <div class="col-md-3">
                <select name="jenis_pinjaman" class="form-control">
                    <option value="">Pilih Jenis Pinjaman</option>
                    <option value="uang" {{ request('jenis_pinjaman') == 'uang' ? 'selected' : '' }}>Uang</option>
                    <option value="barang" {{ request('jenis_pinjaman') == 'barang' ? 'selected' : '' }}>Barang</option>
                </select>
            </div>

            <!-- Search by Tanggal Pinjam -->
            <div class="col-md-3">
                <input type="date" name="tanggal_pinjam" class="form-control" value="{{ request('tanggal_pinjam') }}">
            </div>

            <!-- Search Button -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <a href="{{ route('pinjaman.create') }}" class="btn btn-success mb-3">Tambah Pinjaman</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Total Angsuran</th>
                <th>Sisa Pinjaman</th> <!-- Kolom baru -->
                <th>Tanggal Pinjam</th>
                <th>Di Input Oleh</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinjaman as $p)
            <tr>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->jenis_pinjaman }}</td>
                <td>{{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                <td>{{ number_format($p->angsuran->sum('nominal_angsuran'), 0, ',', '.') }}</td>
                <td>{{ number_format($p->jumlah_pinjaman - $p->angsuran->sum('nominal_angsuran'), 0, ',', '.') }}</td> <!-- Data baru -->
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->admin->name }}</td>
                <td>
                    <a href="{{ route('pinjaman.show', $p->id) }}" class="btn btn-info">Detail</a>
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