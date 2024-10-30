@extends('layouts.simple')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-black text-center">{{ __('Create New Client') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clients.store') }}">
                        @csrf

                        <p class="text-black font-weight-bold mb-2  mt-0 p-1" style="background-color: #D6E9FE;">Client Details</p>

                        <!-- Client Name and Facility Level (side by side) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="client_name" class="text-black">Client Name</label>
                                <input id="client_name" type="text" placeholder="Client name" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" required autocomplete="client_name" autofocus>
                                @error('client_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="facility_level" class="text-black">Facility</label>
                                <select name="facility_level" id="facility_level" class="form-control">
                                    <option value="1" @if(old('facility_level')=='1') selected @endif>Health Centre-I</option>
                                    <option value="2" @if(old('facility_level')=='2') selected @endif>Health Centre-II</option>
                                    <option value="3" @if(old('facility_level')=='3') selected @endif>Health Centre-III</option>
                                    <option value="4" @if(old('facility_level')=='4') selected @endif>Health Centre-IV</option>
                                    <option value="5" @if(old('facility_level')=='5') selected @endif>Clinic</option>
                                    <option value="6" @if(old('facility_level')=='6') selected @endif>Hospital</option>
                                    <option value="7" @if(old('facility_level')=='7') selected @endif>Referral Hospital</option>
                                </select>
                            </div>
                        </div>

                        <!-- Location and Client Email (side by side) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="location" class="text-black">Location</label>
                                <input id="location" type="text" placeholder="Client's location" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location">
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="client_email" class="text-black">Client Email</label>
                                <input id="client_email" type="email" placeholder="Client email" class="form-control @error('client_email') is-invalid @enderror" name="client_email" value="{{ old('client_email') }}" required autocomplete="client_email">
                                @error('client_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Billing Cycle and Amount (side by side) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="billing_cycle" class="text-black">Billing Cycle (Years)</label>
                                <input id="billing_cycle" type="number" placeholder="Billing cycle" class="form-control @error('billing_cycle') is-invalid @enderror" name="billing_cycle" value="{{ old('billing_cycle') }}" required autocomplete="billing_cycle">
                                @error('billing_cycle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="amount" class="text-black">Amount</label>
                                <input id="amount" type="number" placeholder="Amount" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p class="text-black font-weight-bold mb-2  mt-4 " style="background-color: #D6E9FE;">Contact Person's Details</p>

                        <!-- Contact Person Name and Phone (side by side) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contact_name" class="text-black">Name</label>
                                <input id="contact_name" type="text" placeholder="Name" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name') }}" required autocomplete="contact_name">
                                @error('contact_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contact_phone" class="text-black">Phone Number</label>
                                <input id="contact_phone" type="text" placeholder="Phone number" class="form-control @error('contact_phone') is-invalid @enderror" name="contact_phone" value="{{ old('contact_phone') }}" required autocomplete="contact_phone">
                                @error('contact_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p class="text-black font-weight-bold mb-2  mt-4 p-1" style="background-color: #D6E9FE;">Stre@mline Support Engineer Details</p>

                        <!-- Support Engineer Name and Phone (side by side) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="support_engineer_name" class="text-black">Name</label>
                                <input id="support_engineer_name" type="text" placeholder="Name" class="form-control @error('support_engineer_name') is-invalid @enderror" name="support_engineer_name" value="{{ old('support_engineer_name') }}" required autocomplete="support_engineer_name">
                                @error('support_engineer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="support_engineer_phone" class="text-black">Phone Number</label>
                                <input id="support_engineer_phone" type="text" placeholder="Phone number" class="form-control @error('support_engineer_phone') is-invalid @enderror" name="support_engineer_phone" value="{{ old('support_engineer_phone') }}" required autocomplete="support_engineer_phone">
                                @error('support_engineer_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Support Engineer Email -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="support_engineer_email" class="text-black">Email</label>
                                <input id="support_engineer_email" type="email" placeholder="Email" class="form-control @error('support_engineer_email') is-invalid @enderror" name="support_engineer_email" value="{{ old('support_engineer_email') }}" required autocomplete="support_engineer_email">
                                @error('support_engineer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
