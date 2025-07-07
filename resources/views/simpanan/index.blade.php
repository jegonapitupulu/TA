@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Simpanan</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Form -->
    <form action="{{ route('simpanan.index') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Search by User -->
            <div class="col-md-3">
                <input type="text" name="user" class="form-control" placeholder="Cari Nama Penyimpan" value="{{ request('user') }}">
            </div>

            <!-- Search by Jenis Simpanan -->
            <div class="col-md-3">
                <select name="jenis_simpan_id" class="form-control">
                    <option value="">Pilih Jenis Simpanan</option>
                    @foreach($jenisSimpanan as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis_simpan_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_simpanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search by Tanggal Simpan -->
            <div class="col-md-3">
                <input type="date" name="tanggal_simpan" class="form-control" value="{{ request('tanggal_simpan') }}">
            </div>

            <!-- Search Button -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('simpanan.create') }}" class="btn btn-success mb-3">Tambah Simpanan</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Simpanan</th>
                <th>Nominal</th>
                <th>Tanggal Simpan</th>
                <th>Di Inpu Oleh</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($simpanan as $s)
            <tr>
                <td>{{ $s->user->name }}</td>
                <td>{{ $s->jenisSimpanan->nama_jenis_simpanan }}</td>
                <td>{{ $s->jenisSimpanan->nominal }}</td>
                <td>{{ $s->tanggal_simpan }}</td>
                <td>{{ $s->admin->name }}</td>
                <td>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('simpanan.edit', $s->id) }}" class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $s->id }}">Delete</button>
                        <form id="delete-form-{{ $s->id }}" action="{{ route('simpanan.destroy', $s->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Data tidak tersedia</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const simpananId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${simpananId}`).submit();
                }
            });
        });
    });
</script>
@endsection