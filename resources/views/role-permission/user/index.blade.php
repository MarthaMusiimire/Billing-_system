

@extends('layouts.simple')
@section('content')
@include('role-permission.nav-links')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>USERS
                        <a href="{{ route('users.create') }}" class="btn btn-primary float-right">
                            Add User
                        </a>
                    </h4>
                </div>
                <div class="card-body">



                <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th width="450px">Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
            @if ($user->getRoleNames()->isNotEmpty())
            @foreach ($user->getRoleNames() as $roleName)
            <span class="badge bg-primary mx-1">{{ $roleName }}</span>
            @endforeach
        @else
        <span class="text-muted">No Role Assigned</span>
        @endif
            </td>
            <td>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST">

                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                
                
            </form>

            </td>
        </tr>
        @endforeach
    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
