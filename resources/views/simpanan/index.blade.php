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

    <a href="{{ route('simpanan.create') }}" class="btn btn-success mb-3">Tambah Simpanan</a>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Jenis Simpanan</th>
                <th>Nominal</th>
                <th>Tanggal Simpan</th>
                <th>Admin ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($simpanan as $s)
            <tr>
                <td>{{ $s->user->name }}</td>
                <td>{{ $s->jenisSimpanan->nama_jenis_simpanan }}</td>
                <td>{{ $s->jenisSimpanan->nominal }}</td>
                <td>{{ $s->tanggal_simpan }}</td>
                <td>{{ $s->admin->name }}</td>
                <td>
                    <a href="{{ route('simpanan.edit', $s->id) }}" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger btn-delete" data-id="{{ $s->id }}">Delete</button>
                    <form id="delete-form-{{ $s->id }}" action="{{ route('simpanan.destroy', $s->id) }}" method="POST" style="display: none;">
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