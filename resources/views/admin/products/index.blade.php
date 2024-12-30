@extends('layouts.adminapp')
@section('content')
<h1>Products</h1>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('products.create')}}" class="btn btn-primary btn-sm text-white shadow">
            <i class="fas fa-plus"></i> Tambah Product
        </a>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td>Rp{{ number_format($product['price'], 0, ',', '.') }}</td>
                            <td>{{ $product['description'] }}</td>
                            <td><img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" width="50"></td>
                            <td class="d-flex gap-2">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#updateModal{{ $product['id'] }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="updateModal{{ $product['id'] }}" tabindex="-1"
                                    aria-labelledby="updateModalLabel{{ $product['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel{{ $product['id'] }}">Update
                                                    Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin/products/update" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_ids"
                                                        value="{{ implode(',', $product) }}">
                                                    <div class="mb-3">
                                                        <label for="name{{ $product['id'] }}"
                                                            class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name{{ $product['id'] }}" value="{{ $product['name'] }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price{{ $product['id'] }}"
                                                            class="form-label">Price</label>
                                                        <input type="text" name="price" class="form-control"
                                                            id="price{{ $product['id'] }}" value="{{ $product['price'] }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description{{ $product['id'] }}"
                                                            class="form-label">Description</label>
                                                        <input type="text" name="description" class="form-control"
                                                            id="description{{ $product['id'] }}"
                                                            value="{{ $product['description'] }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image{{ $product['id'] }}"
                                                            class="form-label">Image</label>
                                                        <input type="text" name="image" class="form-control"
                                                            id="image{{ $product['id'] }}" value="{{ $product['image'] }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="/admin/products/delete" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    <input type="hidden" name="product_ids" value="{{ implode(',', $product) }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('content')