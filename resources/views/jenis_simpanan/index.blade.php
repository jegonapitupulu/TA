@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Jenis Simpanan</h1>
        <a href="{{ route('jenis_simpanan.create') }}" class="btn btn-primary">Tambah Jenis Simpanan</a>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenis_simpanan as $jp)
                    <tr>
                        <td>{{ $jp->id }}</td>
                        <td>{{ $jp->nama_jenis_simpanan }}</td>
                        <td>{{ $jp->nominal }}</td>
                        <td>
                            <a href="{{ route('jenis_simpanan.edit', $jp->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger btn-delete" data-id="{{ $jp->id }}">Hapus</button>
                            <form id="delete-form-{{ $jp->id }}" action="{{ route('jenis_simpanan.destroy', $jp->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const jenisSimpananId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${jenisSimpananId}`).submit();
                    }
                });
            });
        });
    </script>
@endsection