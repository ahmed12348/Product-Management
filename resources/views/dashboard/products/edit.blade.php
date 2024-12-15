@extends('dashboard.layout')

@section('content')
    <div class="container">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Product Edit Form -->
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Edit Product</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Since we're updating, use the PUT method -->

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price Input -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control" type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantity Input -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Product Edit Form -->
    </div>
@endsection
