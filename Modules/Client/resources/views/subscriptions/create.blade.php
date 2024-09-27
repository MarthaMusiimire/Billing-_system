@extends('layouts.simple')

@section('content')
<div class="container">
    <h2>Create Subscription for {{ $client->client_name }}</h2>
   
    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf

        <input type="hidden" name="client_id" value="{{ $client->id }}">

        <!-- Amount input pre-filled with client amount -->
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" 
                   value="{{ old('amount', $client->amount) }}" required>
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
        </div>

        <!-- End Date -->
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Payment Status -->
        <div class="form-group">
    <label>Payment Status</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="payment_status" id="paid" value="1" {{ old('payment_status') == '1' ? 'checked' : '' }}>
        <label class="form-check-label" for="paid">
            Paid
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="payment_status" id="unpaid" value="0" {{ old('payment_status') == '0' ? 'checked' : '' }}>
        <label class="form-check-label" for="unpaid">
            Unpaid
        </label>
    </div>
    </div>
        <br><br>

        <!-- Submit Button -->
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Create Subscription</button>
        </div>
    </form>
</div>
@endsection