@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <form method="POST" action="{{ route('register') }}" class="form-signin">
                        @csrf
                        <h2 class="form-signin-heading">Create an account</h2>
                            <label for="name" class="sr-only">{{ __('Name') }}</label>
                                <input id="name" type="text" class="top form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="middle form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            <label for="password" class="sr-only">{{ __('Password') }}</label>

                                <input id="password" type="password" class="middle form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="bottom form-control" name="password_confirmation" placeholder="Confirm password" required>

                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            <button class="btn btn-lg btn-success btn-block" onclick="event.preventDefault();location.replace('{{ url('/login') }}')">{{ __('Have an account? Login!') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
