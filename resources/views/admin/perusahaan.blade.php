@extends('layouts.adminapp')
@section('content')
<script src="{{ asset('acharts/dist/apexcharts.js') }}"></script>
<link rel="stylesheet" href="{{ asset('acharts/dist/apexcharts.css') }}" />

<!-- <script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }} -->

<!-- Area Chart -->
<div class="card shadow mb-4">
    <!-- Area Chart -->
    <div>
        <div class="card-header py-3">
            <!-- {!! $chart->container() !!} -->
            <div id="chart"></div>
        </div>
    </div>
</div>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Histori Pembayaran</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>ID Product</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $row)
                        <tr class="text-center">
                            <td>{{$row->product_id}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</div>
<script>
    var options = {
        series: [{
            name: "Data Pembelian",
            data: @json($dataTotalTransaksi)
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Total Pembelian Setiap Bulan',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: @json($dataBulan),
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    });
                }
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection