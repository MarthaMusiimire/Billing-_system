@extends('layouts.simple')

@section('content')
<div class="container">
<form method="GET" action="{{ route('reports.client') }}" id="filterForm">
    <label for="filter">Select Date:</label>
    <select name="filter" id="filter" class="form-control" onchange="handleFilterChange()">
        <option value="one_week" {{ request('filter') == 'one_week' ? 'selected' : '' }}>Next 1 Week</option>
        <option value="two_weeks" {{ request('filter') == 'two_weeks' ? 'selected' : '' }}>Next 2 Weeks</option>
        <option value="one_month" {{ request('filter') == 'one_month' ? 'selected' : '' }}>Next 1 Month</option>
        <option value="date_range" {{ request('filter') == 'date_range' ? 'selected' : '' }}>Date Range</option>
    </select>

    <!-- Date range inputs will be shown dynamically based on the selection -->
    <div id="dateRangeInputs" style="display: none;">
        <div>
            <label for="from_date">From Date:</label>
            <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="form-control">
        </div>
        <div>
            <label for="to_date">To Date:</label>
            <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Search</button>
</form>

<!-- JavaScript to handle the dynamic display of date inputs -->
<script>
    function handleFilterChange() {
        var filter = document.getElementById("filter").value;
        var dateRangeInputs = document.getElementById("dateRangeInputs");

        // Show or hide the date range inputs based on the filter selected
        if (filter === 'date_range') {
            dateRangeInputs.style.display = 'block';
        } else {
            dateRangeInputs.style.display = 'none';
        }
    }

    // Call the function on page load to check the current selected filter (to persist state after form submission)
    window.onload = function() {
        handleFilterChange();
    };
</script><br><br>




<h3>Client Report - Showing Clients due:
    @if($filter == 'one_week')
        Next 1 Week
    @elseif($filter == 'two_weeks')
        Next 2 Weeks
    @elseif($filter == 'one_month')
        Next 1 Month
    @elseif($filter == 'date_range' && $fromDate && $toDate)
        From {{ \Carbon\Carbon::parse($fromDate)->format('jS M Y') }} to {{ \Carbon\Carbon::parse($toDate)->format('jS M Y') }}
    @else
        Custom Date Range
    @endif
</h3>






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