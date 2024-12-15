@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label>office code</label>
            <input type="text" name="office_code" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Optional 1</label>
            <input type="text" name="optional1" class="form-control">
        </div>
        <div class="form-group">
            <label>Optional 2</label>
            <input type="text" name="optional2" class="form-control">
        </div>
        <div class="form-group">
            <label>Roles</label>
            <select name="roles[]" class="form-control" multiple>
                @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>

@endsection