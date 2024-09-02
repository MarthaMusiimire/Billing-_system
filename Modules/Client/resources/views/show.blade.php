@extends('layouts.simple')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Client Details') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Client Name:</div>
                        <div class="col-md-8">{{ $client->client_name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Facility Level:</div>
                        <div class="col-md-8">
                            <span style="color: #555;">{{ $client->facility_level=='1'?'Health Centre-I':
                                ($client->facility_level=='2'?'Health Centre-II':
                                ($client->facility_level=='3'?'Health Centre-III':
                                ($client->facility_level=='4'?'Health Centre-IV':
                                ($client->facility_level=='5'?'Clinic': 
                                ($client->facility_level=='6'?'Hospital': 'Referral Hospital')))))}}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Location:</div>
                        <div class="col-md-8">{{ $client->location }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Contact Person's Name:</div>
                        <div class="col-md-8">{{ $client->contact_name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Contact Person's Phone:</div>
                        <div class="col-md-8">{{ $client->contact_phone }}</div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Support Engineer's Name:</div>
                        <div class="col-md-8">{{ $client->support_engineer_name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Support Engineer's Phone:</div>
                        <div class="col-md-8">{{ $client->support_engineer_phone }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Support Engineer's Email:</div>
                        <div class="col-md-8">{{ $client->support_engineer_email }}</div>
                    </div><br>

                    <!-- Back Button -->
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-5">
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
