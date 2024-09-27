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
                        <!-- Client Name -->
                        <div class="form-group row">
                            <label for="client_name" class="col-md-4 col-form-label text-md-right text-black">Client Name</label>
                            <div class="col-md-8">
                                <input id="client_name" type="text" placeholder="Client name" class="form-control @error('client_name') is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" required autocomplete="client_name" autofocus>
                                @error('client_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Facility Level -->
                        <div class="form-group row">
                            <label for="facility_level" class="col-md-4 col-form-label text-md-right text-black">Facility</label>
                            <div class="col-md-8">
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

                        <!-- Location -->
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right text-black">Location</label>
                            <div class="col-md-8">
                                <input id="location" type="text" placeholder="Client's location" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location">
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <!-- Client Email-->
                        <div class="form-group row">
                            <label for="client_email" class="col-md-4 col-form-label text-md-right text-black">Client Email</label>
                            <div class="col-md-8">
                                <input id="client_email" type="email" placeholder="Client email" class="form-control @error('support_engineer_email') is-invalid @enderror" name="client_email" value="{{ old('client_email') }}" required autocomplete="client_email">
                                @error('support_engineer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        
                                                <!-- Billing Cycle -->
                                                <div class="form-group row">
                            <label for="billing_cycle" class="col-md-4 col-form-label text-md-right text-black">Billing Cycle(Years)</label>
                            <div class="col-md-8">
                                <input id="billing_cycle" type="number" placeholder="Billing cycle" class="form-control @error('billing cycle') is-invalid @enderror" name="billing_cycle" value="{{ old('billing_cycle') }}" required autocomplete="billing_cycle">
                                @error('billing_cycle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                                                <!-- Amount -->
                                                <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right text-black">Amount</label>
                            <div class="col-md-8">
                                <input id="amount" type="number" placeholder="Amount" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <p class="text-black font-weight-bold mb-2  mt-4 " style="background-color: #D6E9FE;">Contact Person's Details</p>
                        <!-- Contact Person Name -->
                        <div class="form-group row ">
                            <label for="contact_name" class="col-md-4 col-form-label text-md-right text-black">Name</label>
                            <div class="col-md-8">
                                <input id="contact_name" type="text" placeholder="Name" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name') }}" required autocomplete="contact_name">
                                @error('contact_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Person Phone -->
                        <div class="form-group row">
                            <label for="contact_phone" class="col-md-4 col-form-label text-md-right text-black">Phone Number</label>
                            <div class="col-md-8">
                                <input id="contact_phone" type="text" placeholder="phone number" class="form-control @error('contact_phone') is-invalid @enderror" name="contact_phone" value="{{ old('contact_phone') }}" required autocomplete="contact_phone">
                                @error('contact_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p class="text-black font-weight-bold mb-2  mt-4 p-1"style="background-color: #D6E9FE;">Stre@mline Support Engineer Details</p>
                        <!-- Support Engineer Name -->
                        <div class="form-group row">
                            <label for="support_engineer_name" class="col-md-4 col-form-label text-md-right text-black">Name</label>
                            <div class="col-md-8">
                                <input id="support_engineer_name" type="text" placeholder="Name" class="form-control @error('support_engineer_name') is-invalid @enderror" name="support_engineer_name" value="{{ old('support_engineer_name') }}" required autocomplete="support_engineer_name">
                                @error('support_engineer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Support Engineer Phone -->
                        <div class="form-group row">
                            <label for="support_engineer_phone" class="col-md-4 col-form-label text-md-right text-black">Phone Number</label>
                            <div class="col-md-8">
                                <input id="support_engineer_phone" type="text" placeholder="phone number" class="form-control @error('support_engineer_phone') is-invalid @enderror" name="support_engineer_phone" value="{{ old('support_engineer_phone') }}" required autocomplete="support_engineer_phone">
                                @error('support_engineer_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Support Engineer Email -->
                        <div class="form-group row">
                            <label for="support_engineer_email" class="col-md-4 col-form-label text-md-right text-black">Email</label>
                            <div class="col-md-8">
                                <input id="support_engineer_email" type="email" placeholder="Email" class="form-control @error('support_engineer_email') is-invalid @enderror" name="support_engineer_email" value="{{ old('support_engineer_email') }}" required autocomplete="support_engineer_email">
                                @error('support_engineer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-12"> <!-- Adjusted to take full width for centering -->
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