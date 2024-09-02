

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
                    <h4>PERMISSIONS
                        
                    </h4>
                </div>
                <div class="card-body">



                <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
           
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            
        </tr>
        @endforeach
    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
