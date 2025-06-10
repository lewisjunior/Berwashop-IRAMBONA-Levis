@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stock Out Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Record Stock Out
        </div>
        <div class="card-body">
            <form action="{{ route('stock.out.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ProductCode" class="form-label">Product</label>
                            <select name="ProductCode" id="ProductCode" class="form-control @error('ProductCode') is-invalid @enderror" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->ProductCode }}">{{ $product->ProductName }}</option>
                                @endforeach
                            </select>
                            @error('ProductCode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="Quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control @error('Quantity') is-invalid @enderror" id="Quantity" name="Quantity" required min="1">
                            @error('Quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="UniquePrice" class="form-label">Selling Price</label>
                            <input type="number" step="0.01" class="form-control @error('UniquePrice') is-invalid @enderror" id="UniquePrice" name="UniquePrice" required min="0">
                            @error('UniquePrice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Record Sale</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Stock Out History
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockOuts as $stockOut)
                            <tr>
                                <td>{{ $stockOut->Date->format('Y-m-d H:i') }}</td>
                                <td>{{ $stockOut->product->ProductName }}</td>
                                <td>{{ $stockOut->Quantity }}</td>
                                <td>{{ number_format($stockOut->UniquePrice, 2) }}</td>
                                <td>{{ number_format($stockOut->TotalPrice, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 