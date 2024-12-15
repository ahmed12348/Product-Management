@extends('layouts.master')


@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label>Password (leave blank to keep current password)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>office code</label>
            <input type="text" name="office_code" class="form-control" value="{{ $user->office_code }}" required>
        </div>
        <div class="form-group">
            <label>Optional 1</label>
            <input type="text" name="optional1" class="form-control" value="{{ $user->optional1 }}">
        </div>
        <div class="form-group">
            <label>Optional 2</label>
            <input type="text" name="optional2" class="form-control" value="{{ $user->optional2 }}">
        </div>
        <div class="form-group">
            <label>Roles</label>
            <select name="roles[]" class="form-control" multiple>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>

@endsection