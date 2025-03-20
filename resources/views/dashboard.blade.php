@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Simpanan</h5>
                    <p class="card-text">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pinjaman</h5>
                    <p class="card-text">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Anggota</h5>
                    <p class="card-text">{{ $totalAnggota }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
