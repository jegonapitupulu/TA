@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Senarai Jenis Pimpanan</h1>
        <a href="{{ route('jenis_pimpanan.create') }}" class="btn btn-primary">Tambah Jenis Pimpanan</a>
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
                @foreach($jenis_pimpanan as $jp)
                    <tr>
                        <td>{{ $jp->id }}</td>
                        <td>{{ $jp->nama_jenis_simpanan }}</td>
                        <td>{{ $jp->nominal }}</td>
                        <td>
                            <a href="{{ route('jenis_pimpanan.edit', $jp->id) }}" class="btn btn-warning">Kemaskini</a>
                            <form action="{{ route('jenis_pimpanan.destroy', $jp->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Padam</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection