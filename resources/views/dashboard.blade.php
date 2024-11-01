@extends('layouts.simple')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <!-- Display the logged-in user's name -->
    <p>Welcome, {{ Auth::user()->name }}!</p>

    <!-- Summary Cards (Responsive Grid) -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Clients</h5>
                    <p class="card-text display-4">{{ $totalClients }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pending Invoices</h5>
                    <p class="card-text display-4">{{ $pendingInvoices }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Revenue This Month</h5>
                    <p class="card-text display-4">{{ number_format($revenueThisMonth, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">New Clients This Month</h5>
                    <p class="card-text display-4">{{ $newClientsThisMonth }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
