@extends('layouts.app')
@section('title')
    Roles and Permissions
@endsection
@section('content')

<div class="container">
    <h2 class="text-center">Manage Roles and Permissions</h2>
    <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">Add New Role</a>
    <hr>
</div>
@stop
