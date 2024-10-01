@extends('layouts.simple')

@section('content')
<div class="container">
    <h3>Client Report due {{ \Carbon\Carbon::parse($selectedDate)->format('jS M Y') }}</h3>

    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('reports.client') }}" method="GET">
                <label for="date">Select Date:</label>
                <input type="date" name="date" id="date" value="{{ $selectedDate }}" class="form-control">
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div><br>

    <ul class="nav nav-tabs" id="reportTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="true">Paid Clients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="unpaid-tab" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid" aria-selected="false">Unpaid Clients</a>
        </li>
    </ul>

    <div class="tab-content" id="reportTabContent">
        <!-- Paid Clients -->
        <div class="tab-pane fade show active" id="paid" role="tabpanel" aria-labelledby="paid-tab">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Facility Level</th>
                        <th>Contact Person</th>
                        <th>Billing Cycle(Years)</th>
                        <th>Invoice Amount</th>
                        <th>Payment Status</th>
                        <th>Next Invoice Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paidClients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->location }}</td>
                        <td>{{ $client->facility_level=='1'? 'HC-I':
                        ($client->facility_level=='2'? 'HC-II':
                        ($client->facility_level=='3'? 'HC-III':
                        ($client->facility_level=='4'? 'HC-IV':
                        ($client->facility_level=='5'? 'Clinic':
                        ($client->facility_level=='6'? 'Hospital':'Referral Hospital')))))}}</td>
                        <td>{{ $client->contact_name }} {{ $client->contact_phone }}</td>
                        <td>{{ $client->billing_cycle }}</td>
                        <td>{{ $client->amount }}</td>
                        <td>
                            <span class="badge badge-success">Paid</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($client->end_date)->format('jS M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Unpaid Clients -->
        <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="unpaid-tab">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Facility Level</th>
                        <th>Contact Person</th>
                        <th>Billing Cycle(Years)</th>
                        <th>Invoice Amount</th>
                        <th>Payment Status</th>
                        <th>Next Invoice Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unpaidClients as $client)
                    <tr>
                    <td>{{ $client->client_name }}</td>
                        <td>{{ $client->location }}</td>
                        <td>{{ $client->facility_level=='1'? 'HC-I':
                        ($client->facility_level=='2'? 'HC-II':
                        ($client->facility_level=='3'? 'HC-III':
                        ($client->facility_level=='4'? 'HC-IV':
                        ($client->facility_level=='5'? 'Clinic':
                        ($client->facility_level=='6'? 'Hospital':'Referral Hospital')))))}}</td>
                        <td>{{ $client->contact_name }} {{ $client->contact_phone }}</td>
                        <td>{{ $client->billing_cycle }}</td>
                        <td>{{ $client->amount }}</td>
                        <td>
                            <span class="badge badge-danger">Unpaid</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($client->end_date)->format('jS M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection