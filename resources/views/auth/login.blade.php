@extends('layouts.app')

@section('content')
    <div class="container login-form">
        <h1 class="theme main-title mb-4"><b>D</b>ENiMA</h1>
        <form method="POST" action="{{ route('login') }}" class="login-subform p-3">
            @csrf

            <h2 class="theme">Login</h2>
            <div class="d-flex align-items-start mb-1">
                <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input-field" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex mt-1 align-items-start">
                <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input-field"
                name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-check mt-3 ml-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="flex align-items-center mb-2 mt-4 ml-3">
                <button type="submit" class="btn btn-default">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="a-default ml-3" href="{{ route('password.request') }}">
                            Forgot Your Password?
                    </a><br>
                @endif
            </div>
        </form>
        <p class="mt-2 ml-3 text-center">New user? <a href="{{ route('register') }}" class="a-default">Register now</a></p>
    </div>
@endsection
