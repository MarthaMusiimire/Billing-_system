@extends('layouts.simple')

@section('content')
@include('role-permission.nav-links')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Role: {{ $role->name }}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="">Permissions</label>

                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6 mb-3">
                                        <h5>{{ $category->name }}</h5>
                                        <div class="row">
                                            @foreach($category->permissions as $permission)
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" 
                                                            name="permissions[]" 
                                                            value="{{ $permission->name }}" 
                                                            class="form-check-input" 
                                                            id="permission-{{ $permission->id }}"
                                                            @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
