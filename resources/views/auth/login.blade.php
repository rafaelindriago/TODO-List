@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="bi bi-box-arrow-right text-muted"></span>
                        {{ __('Login') }}
                    </div>

                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                       for="email">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           autofocus>

                                    @error('email')
                                        <span class="invalid-feedback"
                                              role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                       for="password">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           type="password"
                                           name="password"
                                           required
                                           autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback"
                                              role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               id="remember"
                                               type="checkbox"
                                               name="remember"
                                               {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label"
                                               for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-primary"
                                            type="submit">
                                        <span class="bi bi-box-arrow-right"></span>
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link"
                                           href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
