@extends('auth.layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="ibox-content">
            <h2 class="font-bold" style="text-align: center">Login</h2>
            
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{--{{ old('email') }}--}}" required autocomplete="email" autofocus placeholder="Email">
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

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                 @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>Forgot password?</small>
                    </a>
                @endif

                <p class="text-muted text-center">
                    <small>Do not have an account?</small>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
@endsection
