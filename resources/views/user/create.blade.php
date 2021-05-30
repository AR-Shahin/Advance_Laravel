@extends('layouts.app')
@section('title')
    User
@endsection
@section('content')

<div class="container mt-4">
    <h2 class="text-center">Manage User</h2>
    <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">Add New Role</a>
    <a href="{{ route('user.index') }}" class="btn btn-success btn-sm">User</a>
    <hr>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name </label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email </label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Password </label>
            <input type="password" name="password" class="form-control">
        </div>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Assign Roles</label>
            <div class="col-sm-9">
                <select name="roles" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
            </div>
            <br>
            <button class="btn btn-block btn-success">Submit</button>
        </div>
    </form>
</div>
@stop
