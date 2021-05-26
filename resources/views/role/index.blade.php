@extends('layouts.app')
@section('title')
    Roles and Permissions
@endsection
@section('content')

<div class="container">
    <h2 class="text-center">Manage Roles and Permissions</h2>
    <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">Add New Role</a>
    <a href="{{ route('user.create') }}" class="btn btn-warning btn-sm">Add New User</a>
    <hr>
    <table class="table table-bordered">
        <div class="card-body">
                <table class="table table-bordered text-center mb-3">
                  <thead>
                    <tr>
                      <th width="5%">SL</th>
                      <th width="20%">Name</th>
                      <th width="55%">Permission</th>
                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($roles) != 0)
                        @foreach ($roles as $role)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ ucwords($role->name) }}</td>
                                <td class="text-center">
                                    @foreach ($role->permissions as $item)
                                        <span class="badge badge-primary">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn bg-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Nothing Found.</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
                {{ $roles->links() }}
              </div>
    </table>
</div>
@stop
