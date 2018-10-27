@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <form method="POST" action="{{ route('login') }}" class="form-signin">
                        @csrf
                        <h2 class="form-signin-heading">Please sign in</h2>
                            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="top form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email adress" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            <label for="password" class="sr-only">{{ __('Password') }}</label>

                                <input id="password" type="password" class="bottom form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
                            <button class="btn btn-lg btn-success btn-block" onclick="event.preventDefault();location.replace('{{ url('/register') }}')">{{ __('No account? Register!') }}</button>

                                <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                    </form>
                </div>
            </div>
        </div>
@endsection
