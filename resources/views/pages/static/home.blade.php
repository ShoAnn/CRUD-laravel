@extends('layouts.main')

@section('title', 'Homepage')

@section('header')
    <style>
        @import url("{{ asset('vendor/highcharts/highcharts.css') }}");

        .highcharts-pie-series .highcharts-point {
            stroke: #ede;
            stroke-width: 2px;
        }

        .highcharts-pie-series .highcharts-data-label-connector {
            stroke: silver;
            stroke-dasharray: 2, 2;
            stroke-width: 2px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 220px;
            max-width: auto;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #ffffff;
        }

        .highcharts-data-table th {
            font-weight: 400;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #353535;
        }
    </style>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small Box (Stat card) -->
                <h3 class="mb-2 mt-4">Statistik</h3>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $products->count() }}</h3>
                                <p>Produk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Info detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $categories->count() }}</h3>
                                <p>Kategori</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Info detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($products->sum('price')) }}</h3>
                                <p>Total harga semua produk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Info detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $products->sum('inventory.quantity') }}</h3>
                                <p>Stok total</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Info detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="card col-md-5 mr-4 ">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="product_category"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="card col-md-6">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="price_category"></div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="stock_category"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection

@section('script')
    <script src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/exporting.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/export-data.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/accessibility.js') }}"></script>
    <script type="text/javascript">
        Highcharts.chart('product_category', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'Produk berdasarkan kategori'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.y + '</b> Produk';
                },
                shared: true
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    @foreach ($categories as $category)
                        ['{{ $category->name }}', {{ $category->product->count() }}, false],
                    @endforeach
                ]
            }]
        });

        Highcharts.chart('price_category', {
            chart: {
                type: 'column',
                styledMode: true
            },
            title: {
                text: 'Total harga produk berdasarkan kategori',
                align: 'left'
            },
            xAxis: {
                categories: [
                    @foreach ($categories as $category)
                        '{{ $category->name }}',
                    @endforeach
                ],
                crosshair: true,
                accessibility: {
                    description: 'Kategori produk'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total harga'
                }
            },
            tooltip: {
                formatter: function() {
                    return 'Rp. <b>' + this.y + '</b>';
                },
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total Harga',
                data: [
                    @foreach ($categories as $category)
                        {{ $category->product->sum('price') }},
                    @endforeach
                ]
            }]
        });

        Highcharts.chart('stock_category', {
            chart: {
                type: 'bar',
                styledMode: true
            },
            title: {
                text: 'Stok Produk berdasarkan kategori',
                align: 'left'
            },
            xAxis: {
                categories: [
                    @foreach ($categories as $category)
                        '{{ $category->name }}',
                    @endforeach
                ],
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stok Produk',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            tooltip: {
                valueSuffix: ' PCS'
            },
            plotOptions: {
                bar: {
                    borderRadius: '50%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Stok',
                data: [
                    @foreach ($categories as $category)
                        {{ $category->product->sum('inventory.quantity') }},
                    @endforeach
                ]
            }]
        });
    </script>
@endsection
