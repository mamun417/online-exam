@extends('auth.layouts.app')

@section('content')
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="ibox-content">
            <div style="text-align: center">
                <img alt="image" src="{{ asset('admin/img/logo.png') }}" width="166" />
            </div>

            <h3 class="font-bold">Reset Password</h3>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="m-t" role="form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="Email">
                        @error('email')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary block full-width"><strong>Reset Password</strong></button>
                </form>
            </div>
        </div>
    </div>
@endsection
