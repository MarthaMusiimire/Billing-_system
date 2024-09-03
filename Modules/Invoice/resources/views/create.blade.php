@extends('layouts.simple')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center text-black">
                    <h3>Create New Invoice</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('invoices.store', ['client_id' => $client->id]) }}" method="POST">
                        @csrf
                        

                        <!-- Invoice Header -->
                        <div class="mb-4">
                            <h4 class="text-center mb-3">Invoice Details</h4>
                        </div>

                        <!-- Invoice Details Table -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-black">Client Name:</th>
                                    <td>
                                        <input id="client_name" type="text" class="form-control-plaintext" name="client_name" value="{{ $client->client_name }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-black">Location:</th>
                                    <td>
                                        <input id="location" type="text" class="form-control-plaintext" name="location" value="{{ $client->location }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-black">Billing Cycle (Years):</th>
                                    <td>
                                        <input id="billing_cycle" type="number" class="form-control-plaintext" name="billing_cycle" value="{{ $client->billing_cycle }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-black">Amount:</th>
                                    <td>
                                        <input id="amount" type="number" class="form-control-plaintext" name="amount" value="{{ $client->amount }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-black">Due Date:</th>
                                    <td>
                                        <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" required>
                                        @error('due_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Send Invoice
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-plaintext {
        border: none;
        background-color: #f5f5f5;
    }
    th, td {
        vertical-align: middle;
    }
    .text-black {
        color: #000;
    }
</style>
@endsection
