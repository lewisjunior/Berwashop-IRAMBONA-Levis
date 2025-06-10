@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stock Report</h2>

    <div class="card mb-4">
        <div class="card-header">
            Date Range Filter
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('stock.report') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('stock.report') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Stock Status {{ $startDate && $endDate ? "($startDate to $endDate)" : '(All Time)' }}</span>
            <button class="btn btn-sm btn-success" onclick="window.print()">Print Report</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Opening Stock</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Closing Stock</th>
                            <th>Avg Cost/Unit</th>
                            <th>Total Stock In Value</th>
                            <th>Total Sales Value</th>
                            <th>Profit/Loss</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalOpeningStock = 0;
                            $totalStockIn = 0;
                            $totalStockOut = 0;
                            $totalClosingStock = 0;
                            $totalStockInValue = 0;
                            $totalStockOutValue = 0;
                            $totalProfit = 0;
                        @endphp
                        @foreach($stockReport as $item)
                            @php
                                $totalOpeningStock += $item['opening_stock'];
                                $totalStockIn += $item['total_in'];
                                $totalStockOut += $item['total_out'];
                                $totalClosingStock += $item['current_stock'];
                                $totalStockInValue += $item['total_in_value'];
                                $totalStockOutValue += $item['total_out_value'];
                                $totalProfit += $item['profit'];
                            @endphp
                            <tr>
                                <td>{{ $item['product']->ProductName }}</td>
                                <td>{{ $item['opening_stock'] }}</td>
                                <td>{{ $item['total_in'] }}</td>
                                <td>{{ $item['total_out'] }}</td>
                                <td>
                                    <span class="badge bg-{{ $item['current_stock'] > 0 ? 'success' : 'danger' }}">
                                        {{ $item['current_stock'] }}
                                    </span>
                                </td>
                                <td>{{ number_format($item['avg_cost_per_unit'], 2) }}</td>
                                <td>{{ number_format($item['total_in_value'], 2) }}</td>
                                <td>{{ number_format($item['total_out_value'], 2) }}</td>
                                <td>
                                    <span class="text-{{ $item['profit'] >= 0 ? 'success' : 'danger' }}">
                                        {{ number_format($item['profit'], 2) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-dark">
                            <td><strong>Totals</strong></td>
                            <td><strong>{{ $totalOpeningStock }}</strong></td>
                            <td><strong>{{ $totalStockIn }}</strong></td>
                            <td><strong>{{ $totalStockOut }}</strong></td>
                            <td><strong>{{ $totalClosingStock }}</strong></td>
                            <td></td>
                            <td><strong>{{ number_format($totalStockInValue, 2) }}</strong></td>
                            <td><strong>{{ number_format($totalStockOutValue, 2) }}</strong></td>
                            <td>
                                <strong class="text-{{ $totalProfit >= 0 ? 'success' : 'danger' }}">
                                    {{ number_format($totalProfit, 2) }}
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Report Summary
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Opening Stock</h5>
                            <h3 class="mb-0">{{ $totalOpeningStock }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Investment</h5>
                            <h3 class="mb-0">{{ number_format($totalStockInValue, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <h3 class="mb-0">{{ number_format($totalStockOutValue, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card {{ $totalProfit >= 0 ? 'bg-info' : 'bg-danger' }} text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Profit/Loss</h5>
                            <h3 class="mb-0">{{ number_format($totalProfit, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @media print {
            .navbar, .card-header button, form {
                display: none !important;
            }
            .card {
                border: none !important;
            }
            .card-header {
                background-color: white !important;
                border-bottom: 2px solid #dee2e6 !important;
            }
            .badge {
                border: 1px solid #dee2e6 !important;
            }
            .text-success {
                color: #28a745 !important;
            }
            .text-danger {
                color: #dc3545 !important;
            }
        }
    </style>
    @endpush
</div>
@endsection 