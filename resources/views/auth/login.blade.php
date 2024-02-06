@extends('layouts.login')
@section('content')
   <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">{{ __('Login') }}</div>
      <div class="card-body">
        <form method="post" action="{{ route('login') }}">
          @csrf
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

          <div class="form-group">
              <label>{{ __('Email Address') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

          </div>

          <div class="form-group">
              <label>{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group" style="text-align:center">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
          </div>
          <button type="submit" class="btn btn-primary btn-block">
              {{ __('Login') }}
          </button>
          <div class="form-group" style="text-align:center">
              @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif
          </div>
        </form>
      </div>
    </div>
  </div>
@stop