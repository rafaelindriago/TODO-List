@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="bi bi-person-plus text-muted"></span>
                        {{ __('Register') }}
                    </div>

                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                       for="name">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           type="text"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autocomplete="name"
                                           autofocus>

                                    @error('name')
                                        <span class="invalid-feedback"
                                              role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                           autocomplete="email">

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
                                           autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback"
                                              role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                       for="password-confirm">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control"
                                           id="password-confirm"
                                           type="password"
                                           name="password_confirmation"
                                           required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary"
                                            type="submit">
                                        <span class="bi bi-person-plus"></span>
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
