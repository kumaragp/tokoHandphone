@extends('layouts.adminapp')
@section('content')
<div class="container">
    <h1 class="mb-4">Add New Product</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price"
                        required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control"
                        placeholder="Enter product description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image Link</label>
                    <input type="text" name="image" id="image" class="form-control"
                        placeholder="Enter product image URL" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection