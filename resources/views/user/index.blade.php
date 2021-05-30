@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')

<div class="container">
    <h2 class="text-center">Manage Users</h2>
    <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">Add New Role</a>
    <a href="{{ route('user.create') }}" class="btn btn-warning btn-sm">Add New User</a>
    <hr>
    <table class="table table-bordered">
        <div class="cardf-body">
                <table class="table table-bordered text-center mb-3">
                  <thead>
                    <tr>
                      <th width="5%">SL</th>
                      <th width="20%">Name</th>
                      <th width="55%">Email</th>
                       <th width="55%">users</th>
                      <th width="20%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ ucwords($user->name) }}</td>
                                 <td class="text-center">{{ ucwords($user->email) }}</td>
                                 <td>
                                     @foreach ($user->roles as $role)
                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                @endforeach
                                   <td class="text-center">
                                    @if ($user->can('admin.edit'))
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn bg-info"><i class="fas fa-edit"></i></a>
                                    @endif
                                    @if ($user->can('admin.delete'))
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                                 </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
    </table>
</div>
@stop
