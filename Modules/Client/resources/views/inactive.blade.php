@extends('layouts.simple')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Inactive Clients</h2>

        <!-- Search Form -->
       
    <form method="GET" action="{{ route('clients.inactive') }}" class="mb-4">
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

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($clients->isEmpty())
            <div class="alert alert-info">
                No inactive Client found.
            </div>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Client Name</th>
                        <th>Facility Level</th>
                        <th>Location</th>
                        <th>Contact Person</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $index => $client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->client_name }}</td>
                            <td>{{ $client->facility_level=='1'? 'Health Centre-I':
                                ($client->facility_level=='2'? 'Health Centre-II':
                                ($client->facility_level=='3'? 'Health Centre-III':
                                ($client->facility_level=='4'? 'Health Centre-IV':
                                ($client->facility_level=='5'? 'Clinic':
                                ($client->facility_level=='6'? 'Hospital':'Referral Hospital')))))}}</td>
                            
                            <td>{{ $client->location }}</td>
                            <td>{{ $client->contact_name }} - {{$client->contact_phone}} </td>
                            <td>
                                <form action="{{ route('clients.restore', $client->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('clients.index') }}" class="btn btn-primary mt-4">Back to Active Patients</a>
    </div>
@endsection