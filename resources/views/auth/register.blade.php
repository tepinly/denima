@extends('layouts.app')

@section('content')
    <div class="container login-form">
        <h1 class="theme main-title mb-4"><b>D</b>ENiMA</h1>
        <form method="POST" action="{{ route('register') }}" class="login-subform p-3">
            @csrf

            <h2 class="theme">Register</h2>
            <div class="d-flex align-items-start mb-1">
                <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror input-field" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex align-items-start mb-1">
                <label for="email" class="col-md-2 col-form-label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input-field" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex align-items-start mb-1">
                <label for="password" class="col-md-2 col-form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input-field"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex align-items-start mb-1">
                <label for="password-confirm"
                    class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control input-field" name="password_confirmation" required
                    autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-default mt-3 ml-3">
                {{ __('Register') }}
            </button>
        </form>
    </div>
@endsection
