@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Detail Anggota</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $anggota->name }}</p>
            <p><strong>Email:</strong> {{ $anggota->email }}</p>
            <p><strong>Alamat:</strong> {{ $anggota->alamat }}</p>
            <p><strong>Nomor HP:</strong> {{ $anggota->hp }}</p>
            <p><strong>TMT:</strong> {{ $anggota->tmt }}</p>
            <p><strong>Status:</strong> {{ ucfirst($anggota->status) }}</p>
            <p><strong>Role:</strong> {{ ucfirst($anggota->role) }}</p>
            @if($anggota->role === 'anggota')
                <p><strong>Badge:</strong> {{ $anggota->badge }}</p>
                <p><strong>Nomor Anggota:</strong> {{ $anggota->no_anggota }}</p>
                <p><strong>Nomor Rekening:</strong> {{ $anggota->no_rekening }}</p>
                <p><strong>Bank:</strong> {{ $anggota->bank }}</p>
            @endif
        </div>
    </div>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection