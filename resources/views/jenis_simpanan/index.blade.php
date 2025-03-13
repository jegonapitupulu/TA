@extends('layouts.main')

@section('content')
    <div class="container">
        <h1> Jenis simpanan</h1>
        <a href="{{ route('jenis_simpanan.create') }}" class="btn btn-primary">Tambah Jenis Pimpanan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nama</th>
                    <th>nominal</th>
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
                            <a href="{{ route('jenis_simpanan.edit', $jp->id) }}" class="btn btn-warning">edit</a>
                            <form action="{{ route('jenis_simpanan.destroy', $jp->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection