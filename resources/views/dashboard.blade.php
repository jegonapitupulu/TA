@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalAnggota }}</h3>
                    <p>Total Anggota</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z"></path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>

        <!-- Total Simpanan -->
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h3>
                    <p>Total Simpanan</p>
                </div>
            </div>
        </div>

        <!-- Total Pinjaman -->
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</h3>
                    <p>Total Pinjaman</p>
                </div>
            </div>
        </div>

        <!-- Total Admins -->
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $totalAdmins }}</h3>
                    <p>Total Admins</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Highcharts Graph -->
    <div class="mt-5">
        <h2>Jumlah Pinjaman per Bulan (2025)</h2>
        <div id="loan-chart"></div>
    </div>
</div>

<!-- Include Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('loan-chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Pinjaman per Bulan (2025)'
            },
            xAxis: {
                categories: [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Pinjaman (Rp)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp {point.y:,.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Jumlah Pinjaman',
                data: [
                    {{ $monthlyPinjaman[1] ?? 0 }}, {{ $monthlyPinjaman[2] ?? 0 }}, {{ $monthlyPinjaman[3] ?? 0 }},
                    {{ $monthlyPinjaman[4] ?? 0 }}, {{ $monthlyPinjaman[5] ?? 0 }}, {{ $monthlyPinjaman[6] ?? 0 }},
                    {{ $monthlyPinjaman[7] ?? 0 }}, {{ $monthlyPinjaman[8] ?? 0 }}, {{ $monthlyPinjaman[9] ?? 0 }},
                    {{ $monthlyPinjaman[10] ?? 0 }}, {{ $monthlyPinjaman[11] ?? 0 }}, {{ $monthlyPinjaman[12] ?? 0 }}
                ]
            }]
        });
    });
</script>
@endsection
