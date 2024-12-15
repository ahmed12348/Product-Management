@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">

                <a class="btn btn-success" href="{{ route('dashboard.users.create') }}">Create New User</a>
                <!-- @can('user-create')
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
                <h5 class="mb-0">Users</h5>
                <form class="ms-auto position-relative" method="GET" action="{{ route('dashboard.users.index') }}">
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                  
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Counter -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                          
                                <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('dashboard.users.show', $user->id) }}" class="text-primary"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="View">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="text-warning"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        @can('user-delete')
                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        @can('user-edit')
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!} <!-- Pagination -->
            </div>
        </div>
    </div>
@endsection
