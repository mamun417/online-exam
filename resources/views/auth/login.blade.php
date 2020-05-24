@extends('auth.layouts.app')

@section('content')
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="ibox-content shadow">

            <div style="text-align: center">
                <img alt="image" src="{{ asset('admin/img/logo.png') }}" width="166" />
            </div>

            <h3 class="font-bold">Login</h3>

            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>Oops!</strong> {{ $message }}
                </div>
            @endif()

            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" value="" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b"><strong>Login</strong></button>

                <a href="login/facebook" class="btn btn-block btn-social btn-facebook m-b" style="margin-top: 10px">
                    <span class="fa fa-facebook"></span> Sign in with Facebook
                </a>
                <a href="login/google" class="btn btn-block btn-social btn-google m-b">
                    <span class="fa fa-google"></span> Sign in with Google
                </a>

                <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>

                <p class="text-center">
                    <span>Do not have an account?</span>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>

            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
@endsection
