
@extends('layouts.simple')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Clients</h2>

    <!-- Search Form -->
       
    <form method="GET" action="{{ route('clients.index') }}" class="mb-4">
        <div class="form-group row">
            <label for="search" class="col-md-2 col-form-label text-md-right">Search by Client Name</label>
            <div class="col-md-10">
                <div class="input-group">
                    <input id="search" type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Enter client name">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div><br>

        @if ($message = Session::get('status'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


        <a href="{{ route('clients.create') }}" class="btn btn-primary float-right">Add Client</a><br>
    </form>




    <!-- Clients Table -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Client Name</th>
                <th>Facility Level</th>
                <th>Location</th>
                <th>Contact Person</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->client_name }}</td>
                    <td>{{ $client->facility_level=='1'? 'Health Centre-I':
                        ($client->facility_level=='2'? 'Health Centre-II':
                        ($client->facility_level=='3'? 'Health Centre-III':
                        ($client->facility_level=='4'? 'Health Centre-IV':
                        ($client->facility_level=='5'? 'Clinic':
                        ($client->facility_level=='6'? 'Hospital':'Referral Hospital')))))}}</td>
                    <td>{{ $client->location }}</td>
                    <td>{{ $client->contact_name }}  -  {{$client->contact_phone}} </td>
                    <td>
                        <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
        
                            <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Details</a>

                            <a href="{{ route('invoices.create', ['client_id' => $client->id]) }}" class="btn btn-warning">Create Invoice</a>



            
                            <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Edit</a>

        
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection