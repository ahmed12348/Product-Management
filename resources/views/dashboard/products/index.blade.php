@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">products List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">

                <a class="btn btn-success" href="{{ route('dashboard.products.create') }}">Create New product</a>
                <!-- @can('products-create')
    @endcan -->
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <script>
                    Swal.fire({
                        title: 'Error!',
                        html: `
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>`,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if (session('success'))
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'success',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif


            <div class="d-flex align-items-center">
                <h5 class="mb-0">products</h5>
                <form class="ms-auto position-relative" method="GET" action="{{ route('dashboard.products.index') }}">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" name="search" placeholder="Search"
                        value="{{ request()->query('search') }}">
                </form>
            </div>

            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="text-warning">
                            <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 text-danger">
                                <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
                {!! $products->links() !!} <!-- Pagination -->
            </div>
        </div>
    </div>
@endsection
