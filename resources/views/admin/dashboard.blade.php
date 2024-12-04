@extends('admin.app')

@section('content')
<section id="dashboard-analytics">
    <div class="row">
        <!-- Sales Tile -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-pound-sign font-medium-5">£</i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder">£{{ number_format($tiles['totalSales'], 2) }}</h2>
                        <p class="card-text">Total Sales</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Tile -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-package font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder">{{ $tiles['totalProducts'] }}</h2>
                        <p class="card-text">Total Products</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branches Tile -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-map-pin font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder">{{ $tiles['totalBranches'] }}</h2>
                        <p class="card-text">Total Branches</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Product Tile -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-star font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder">{{ $tiles['topProduct'] }}</h2>
                        <p class="card-text">Top Product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphs Section -->
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales by Branch</h4>
                </div>
                <div class="card-body">
                    <canvas id="salesByBranchChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Products</h4>
                </div>
                <div class="card-body">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Monthly Sales</h4>
                </div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Sales Trend</h4>
                </div>
                <div class="card-body">
                    <canvas id="productSalesTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sales by Branch Chart
        new Chart(document.getElementById('salesByBranchChart'), {
            type: 'bar',
            data: {
                labels: @json($graphs['salesByBranch']->pluck('branch.branch_name')),
                datasets: [{
                    label: 'Total Sales',
                    data: @json($graphs['salesByBranch']->pluck('total_sales')),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            }
        });

        // Top Products Chart
        new Chart(document.getElementById('topProductsChart'), {
            type: 'pie',
            data: {
                labels: @json($graphs['topProducts']->pluck('product_name')),
                datasets: [{
                    data: @json($graphs['topProducts']->pluck('sold_quantity')),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                }]
            }
        });

        // Monthly Sales Chart
        new Chart(document.getElementById('monthlySalesChart'), {
            type: 'line',
            data: {
                labels: @json($graphs['monthlySales']->pluck('month')),
                datasets: [{
                    label: 'Total Sales',
                    data: @json($graphs['monthlySales']->pluck('total_sales')),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    fill: true
                }]
            }
        });

        // Product Sales Trend Chart
        new Chart(document.getElementById('productSalesTrendChart'), {
            type: 'line',
            data: {
                labels: @json($graphs['topProducts']->pluck('product_name')),
                datasets: [{
                    label: 'Sales Trend',
                    data: @json($graphs['topProducts']->pluck('sold_quantity')),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    fill: false
                }]
            }
        });
    });
</script>
@endsection
