@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="ProductCode" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="ProductCode" value="{{ $product->ProductCode }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="ProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('ProductName') is-invalid @enderror" id="ProductName" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}" required>
                            @error('ProductName')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 