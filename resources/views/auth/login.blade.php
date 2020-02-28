@extends('auth.layouts.app')

@section('content')
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="ibox-content">
            <h2 class="font-bold" style="text-align: center">Login</h2>

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

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>

                <p class="text-muted text-center">
                    <small>Do not have an account?</small>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
                <a href="login/facebook" class="btn btn-block btn-social btn-facebook" style="margin-top: 10px">
                    <span class="fa fa-facebook"></span> Sign in with Facebook
                </a>
                <a href="login/google" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google"></span> Sign in with Google
                </a>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
@endsection
