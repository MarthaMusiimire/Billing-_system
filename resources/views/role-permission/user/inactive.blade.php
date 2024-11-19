@extends('layouts.simple')

@section('content')
<div class="container">
    <form action="{{ route('users.inactive') }}" method="POST">
        <h3>Inactive Users</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inactiveUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No inactive users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>
</div>
@endsection
