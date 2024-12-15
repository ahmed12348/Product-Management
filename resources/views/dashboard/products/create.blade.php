@extends('dashboard.layout')

@section('content')
    <div class="container">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <!-- Back Button -->
                <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Product Creation Form -->
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Create New Product</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.products.store') }}" method="POST" id="create"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter product name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description" required></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control" type="number" id="price" name="price"
                                    placeholder="Enter product price" step="0.01" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Quantity -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity"
                                    placeholder="Enter product quantity" required>
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Product Creation Form -->
    </div>

    <!-- Scripts to add Select2 functionality (Optional if you want to use Select2) -->
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection
