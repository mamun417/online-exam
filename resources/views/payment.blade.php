@extends('auth.layouts.app')

@section('content')
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="ibox-content">

            <div style="text-align: center">
                <img alt="image" src="{{ asset('admin/img/logo.png') }}" width="166" />
            </div>

            <h3 class="font-bold">Billing address</h3>

            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>Oops!</strong> {{ $message }}
                </div>
            @endif()

            <form class="m-t" role="form" method="POST" action="{{ url('/pay') }}">
                @csrf

                <div class="form-group">
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                           name="customer_name"
                           value="{{ auth()->user()->name.' '. auth()->user()->last_name }}"
                           required autofocus placeholder="Full Name"
                    >
                    @error('customer_name')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('customer_email') is-invalid @enderror"
                           name="customer_email" value="{{ auth()->user()->email }}"
                           required autocomplete="email" autofocus
                           placeholder="Email Address"
                    >
                    @error('customer_email')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('customer_mobile') is-invalid @enderror"
                           name="customer_mobile" value="{{ auth()->user()->phone }}"
                           autofocus placeholder="Mobile"
                    >
                    @error('customer_mobile')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('customer_address') is-invalid @enderror"
                           name="customer_address" value="{{ auth()->user()->address ?? '' }}"
                           autofocus placeholder="Full Address"
                    >
                    @error('customer_address')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control" name="customer_country">
                        <option value="">Choose Country</option>
                        <option value="Bangladesh">Bangladesh</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control" name="customer_state">
                        <option value="">Choose State</option>
                        <option value="Dhaka">Dhaka</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="customer_zip" value="" autofocus placeholder="Zip">
                </div>

                <button type="submit" class="btn btn-primary block full-width"><strong>Pay Now</strong></button>
            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
@endsection
