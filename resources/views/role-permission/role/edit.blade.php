

@extends('layouts.simple')

@section('content')
@include('role-permission.nav-links')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h4>ROLES
                        <a href="{{ route('roles.index') }}" class="btn btn-danger float-right">
                            Back
                        </a>
                    </h4>
                    <div class="card-body">
                        <form action ="{{ route('roles.update', '$role->id') }}"  method="POST">
                            @csrf
                            @method('PUT')
                            <div class = "mb-3">
                                <label for="">Role Name</label>
                                <input type="text" name="name" class="form-control" value="{{old ('name', $role->name)}}" />
                            </div>
                            <div class = "mb-3">
                                <button type="submit", class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
