@extends('admin.partials.app')

@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Visits</h5>
                        <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Online Users</h5>
                        <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Active Users</h5>
                        <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-8">
        <div class="card bg-gradient-default shadow-lg">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                        <h2 class="text-white mb-0">Sales value</h2>
                    </div>

                    <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales"
                            data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$"
                            data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                    <span class="d-none d-md-block">Month</span>
                                    <span class="d-md-none">M</span>
                                </a>
                            </li>

                            <li class="nav-item" data-toggle="chart" data-target="#chart-sales"
                            data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$"
                            data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                    <span class="d-none d-md-block">Week</span>
                                    <span class="d-md-none">W</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                    <!-- Chart wrapper -->
                    <canvas id="chart-sales" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card shadow-lg">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                        <h2 class="mb-0">Total orders</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <!-- Chart -->
                <div class="chart">
                    <canvas id="chart-orders" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col">
        <div class="card shadow-lg">
            <div class="card-header border-5">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">CMS Activites</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#!" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Page name</th>
                            <th scope="col">Visitors</th>
                            <th scope="col">Unique users</th>
                            <th scope="col">Bounce rate</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th scope="row">
                            /argon/
                            </th>
                            <td>
                            4,569
                            </td>
                            <td>
                            340
                            </td>
                            <td>
                            <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            /argon/index.html
                            </th>
                            <td>
                            3,985
                            </td>
                            <td>
                            319
                            </td>
                            <td>
                            <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            /argon/charts.html
                            </th>
                            <td>
                            3,513
                            </td>
                            <td>
                            294
                            </td>
                            <td>
                            <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            /argon/tables.html
                            </th>
                            <td>
                            2,050
                            </td>
                            <td>
                            147
                            </td>
                            <td>
                            <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            /argon/profile.html
                            </th>
                            <td>
                            1,795
                            </td>
                            <td>
                            190
                            </td>
                            <td>
                            <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <script src="/argon/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/argon/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush